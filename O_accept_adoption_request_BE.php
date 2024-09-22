<?php 
    include('./db_con.php');
    session_start();
    $acc_id = $_SESSION['acc_id'];
    $adoption_id = $_GET['adoption_id'];
    $orphan_id = $_GET['orphan_id'];
    $user_id = $_GET['user_id'];
    $current_date = date('d-m-y');
    $query1 = "SELECT first_name, last_name FROM orphan_list WHERE orphan_id = $orphan_id";
    $result1 = mysqli_query($con,$query1);
    if(mysqli_num_rows($result1) == 1){
        $row1 = mysqli_fetch_assoc($result1);
        $firstName = $row1['first_name'];
        $lastName = $row1['last_name'];
    }
    $query2 = "UPDATE adoptions AS ad SET ad.status = 1, ad.issued_date = '$current_date' WHERE ad.adoption_id = $adoption_id AND ad.status != 1";
        if(mysqli_query($con, $query2)) {
            $sql = "SELECT o.org_id FROM accounts AS a LEFT JOIN org_list AS o ON a.acc_id = o.acc_id Where a.acc_id = $acc_id";
            $sql_result = mysqli_query($con, $sql);
            if (mysqli_num_rows($sql_result) == 1) {
                $row = mysqli_fetch_array($sql_result);
                $org_id = $row['org_id'];
            }
            
            $sql2 = "UPDATE orphan_list SET adoption_status = 1 WHERE orphan_id = $orphan_id";
            mysqli_query($con, $sql2);

            $content = "You approved $firstName $lastName for adoption.";
            $queryNotifications = "INSERT INTO notifications (org_id, orphan_id, content) VALUES (?, ?, ?)";
            $stmtNotifications = mysqli_prepare($con, $queryNotifications);
            mysqli_stmt_bind_param($stmtNotifications, "iis",$org_id, $orphan_id, $content);
            mysqli_stmt_execute($stmtNotifications);
            mysqli_stmt_close($stmtNotifications);

            $content = "Adoption request for $firstName $lastName has been approved!";
            $queryNotifications = "INSERT INTO notifications (user_id, orphan_id, content) VALUES (?, ?, ?)";
            $stmtNotifications = mysqli_prepare($con, $queryNotifications);
            mysqli_stmt_bind_param($stmtNotifications, "iis",$user_id, $orphan_id, $content);
            mysqli_stmt_execute($stmtNotifications);
            mysqli_stmt_close($stmtNotifications);

            $_SESSION['positive'] = "Request approved";
            header("Location: ./O_profile.php");
            } else {
                $_SESSION['negative'] = "Error occured, query failed";
                header("Location: ./O_profile.php");
            }
