<?php

include('./db_con.php');
session_start();

if (!isset($_SESSION['acc_id']) && !isset($_SESSION['role'])) {
    $_SESSION['notify'] = "Warning: Please login first.";
    header("Location: ./login.php");
    exit(0);
} else {
    $acc_id = $_SESSION['acc_id'];

    $sql = "SELECT acc.acc_email, acc.role, acc.acc_join_date, usr.user_id, usr.user_name, usr.user_birth, usr.user_contact, usr.user_gender, usr.user_NID, usr.user_address, usr.user_website, usr.user_job, usr.user_location, usr.user_image FROM accounts AS acc LEFT JOIN user_list AS usr ON acc.acc_id = usr.acc_id Where acc.acc_id = $acc_id";

    $sql_result = mysqli_query($con, $sql);
    if (mysqli_num_rows($sql_result) == 1) {

        $row = mysqli_fetch_array($sql_result);

        $_SESSION['user_id'] = $row['user_id'];
        $acc_email = $row['acc_email'];
        $role = $row['role'];
        $acc_join_date = $row['acc_join_date'];
        $user_id = $row['user_id'];
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
}

?>
