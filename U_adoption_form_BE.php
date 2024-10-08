<?php

    include('./db_con.php');

    if (isset($_POST['submit'])) {

        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $occupation = $_POST['occupation'];
        $income = $_POST['income'];
        $maritalStatus = $_POST['maritalStatus'];
        $reason = $_POST['reason'];
        $children = $_POST['children'];
        $livingEnvironment = $_POST['livingEnvironment'];
        $expectations = $_POST['expectations'];
        $additionalInfo = $_POST['additionalInfo'];
        $orphan_id = $_POST['orphan_id'];
        $acc_id = $_POST['acc_id'];
        $request_date = date('d-m-y');
        $query = "INSERT INTO adoptions (orphan_id, acc_id, email, phone, occupation, income, maritalStatus, reason, children, livingEnvironment, expectations, additionalInfo, request_date) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "iisssdssissss", $orphan_id, $acc_id, $email, $phone, $occupation, $income, $maritalStatus, $reason, $children, $livingEnvironment, $expectations, $additionalInfo, $request_date);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        $sql = "SELECT org_id, first_name, last_name FROM orphan_list WHERE orphan_id = $orphan_id";
        $result = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $org_id = $row['org_id'];
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
        }

        $sql2 = "SELECT user_id, user_name FROM user_list WHERE acc_id = $acc_id";
        $result2 = mysqli_query($con, $sql2);
        while ($row2 = mysqli_fetch_assoc($result2)) {
            $user_id = $row2['user_id'];
            $user_name = $row2['user_name'];
        }
        $content = "Adoption Request Sent for $first_name $last_name.";
        $queryNotifications = "INSERT INTO notifications (user_id, orphan_id, content) VALUES (?, ?, ?)";
        $stmtNotifications = mysqli_prepare($con, $queryNotifications);
        mysqli_stmt_bind_param($stmtNotifications, "iis", $user_id, $orphan_id, $content);
        mysqli_stmt_execute($stmtNotifications);
        mysqli_stmt_close($stmtNotifications);

        $content = "$user_name Requested adoption for $first_name $last_name.";
        $queryNotifications = "INSERT INTO notifications (org_id, orphan_id, content) VALUES (?, ?, ?)";
        $stmtNotifications = mysqli_prepare($con, $queryNotifications);
        mysqli_stmt_bind_param($stmtNotifications, "iis", $org_id, $orphan_id, $content);
        mysqli_stmt_execute($stmtNotifications);
        mysqli_stmt_close($stmtNotifications);

        header("Location: ./U_profile.php");
    }
    mysqli_close($con);