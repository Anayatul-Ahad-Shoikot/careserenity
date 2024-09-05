<?php

include('db_con.php');
    session_start();

    $user_id = $_GET['user_id'];
    $sql = "SELECT usr.user_name, usr.user_birth, usr.user_contact, usr.user_gender, usr.user_NID, usr.user_address, usr.user_website, usr.user_job, usr.user_location, usr.user_image, acc.acc_email, acc.acc_join_date FROM user_list AS usr LEFT JOIN accounts AS acc ON usr.acc_id = acc.acc_id Where usr.user_id = $user_id";

    $sql_result = mysqli_query($con, $sql);
    if (mysqli_num_rows($sql_result) == 1) {

        $row = mysqli_fetch_array($sql_result);
        $acc_email = $row['acc_email'];
        $acc_join_date = $row['acc_join_date'];
        $user_name = $row['user_name'];
        $user_birth = $row['user_birth'];
        $user_contact = $row['user_contact'];
        $user_gender = $row['user_gender'];
        $user_NID = $row['user_NID'];
        $user_address = $row['user_address'];
        $user_website = $row['user_website'];
        $user_job = $row['user_job'];
        $user_location = $row['user_location'];
        $user_image = $row['user_image'];
    } else {
        echo "User data not found.";
    }
?>
