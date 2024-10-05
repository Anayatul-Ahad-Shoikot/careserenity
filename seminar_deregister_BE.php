<?php
    include_once './db_con.php';
    session_start();

    $user_id = $_GET['user_id'];
    $seminar_id = $_GET['seminar_id'];

    $deleteQuery = "DELETE FROM seminar_participants WHERE seminar_id = $seminar_id AND participant_id = $user_id";
    if (mysqli_query($con, $deleteQuery)) {
        $_SESSION['positive'] = "You have successfully canceled your registration for the seminar.";

        $query2 = "SELECT title, seminar_date FROM seminars WHERE seminar_id = $seminar_id";
        $result2 = mysqli_query($con, $query2);
        $row2 = mysqli_fetch_assoc($result2);

        $content = "You have canceled seminar registration for {$row2['title']} on {$row2['seminar_date']}.";
        $queryNotifications = "INSERT INTO notifications (user_id, content) VALUES (?, ?)";
        $stmtNotifications = mysqli_prepare($con, $queryNotifications);
        mysqli_stmt_bind_param($stmtNotifications, "is", $user_id, $content);
        mysqli_stmt_execute($stmtNotifications);
        mysqli_stmt_close($stmtNotifications);
        
    } else {
        $_SESSION['positive'] = "Failed to cancel registration!";
    }

    if($_SESSION['role'] == 'org'){
        header("Location: ./O_seminar.php");
        exit(0); 
    } else {
        header("Location: ./U_seminar.php");
        exit(0); 
    }
?>
