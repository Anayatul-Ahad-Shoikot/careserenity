<?php
    include_once './db_con.php';
    session_start();
    $user_id = $_GET['user_id'];
    $seminar_id = $_GET['seminar_id'];
    $date = date("Y-m-d");
    $checkQuery = "SELECT * FROM seminar_participants WHERE seminar_id = $seminar_id AND participant_id = $user_id";
    $checkResult = mysqli_query($con, $checkQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        $_SESSION['positive'] = "You are already registered for this seminar!";
        header("Location: ./U_seminar.php");
        exit(0);
    } else {
        $insertQuery = "INSERT INTO seminar_participants (seminar_id, participant_id, reg_date) VALUES ($seminar_id, $user_id, '$date')";
        if (mysqli_query($con, $insertQuery)) {
            $_SESSION['positive'] = "Registration successful!";

            $query2 = "SELECT title, seminar_date FROM seminars WHERE seminar_id = $seminar_id";
            $result2 = mysqli_query($con, $query2);
            $row2 = mysqli_fetch_assoc($result2);

            $content = "You have registerd for {$row2['title']} on {$row2['seminar_date']}.";
            $queryNotifications = "INSERT INTO notifications (user_id, content) VALUES (?, ?)";
            $stmtNotifications = mysqli_prepare($con, $queryNotifications);
            mysqli_stmt_bind_param($stmtNotifications, "is", $user_id, $content);
            mysqli_stmt_execute($stmtNotifications);
            mysqli_stmt_close($stmtNotifications);
        } else {
            $_SESSION['positive'] = "Registration failed!";
        }

        if($_SESSION['role'] == 'org'){
            header("Location: ./O_seminar.php");
            exit(0); 
        } else {
            header("Location: ./U_seminar.php");
            exit(0); 
        }

    }
?>