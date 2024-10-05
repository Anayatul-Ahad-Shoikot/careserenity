<?php

    include './db_con.php';
    session_start();
        $acc_id = $_SESSION['acc_id'];
        $sql = "SELECT al.*, a.acc_email, a.acc_join_date FROM admin_list AS al LEFT JOIN accounts AS a ON a.acc_id = al.acc_id Where al.acc_id = $acc_id";
        $sql_result = mysqli_query($con, $sql);
        if (mysqli_num_rows($sql_result) == 1) {
            $row = mysqli_fetch_array($sql_result);
            $admin_id = $row['admin_id'];
            $admin_name = $row['admin_name'];
            $admin_contact = $row['admin_contact'];
            $admin_priyority = $row['admin_priyority'];
            $admin_image = $row['admin_image'];
            $admin_email = $row['acc_email'];
            $acc_join_date = $row['acc_join_date'];
        } 
        else {
            $_SESSION['negative'] = "Admin data not found !";
            header("Location: ./login.php");
            exit();
        }

    mysqli_close($con); 
