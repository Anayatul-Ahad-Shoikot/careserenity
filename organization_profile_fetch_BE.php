<?php

include('db_con.php');
session_start();

if (!isset($_SESSION['acc_id']) && !isset($_SESSION['role'])) {
    $_SESSION["negative"] = "Warning. You have to login first";
    header("Location: /FrontEnd/loggedOut/login.php");
    exit();
} else {
    $acc_id = $_SESSION['acc_id'];

    $sql = "SELECT acc.acc_name, acc.acc_email, acc.role, acc.acc_join_date, org.org_id, org.org_name, org.org_description, org.org_email, org.org_phone, org.org_website, org.org_logo, org.established, org.org_location, org.org_vision, org.org_reviews FROM accounts AS acc LEFT JOIN org_list AS org ON acc.acc_id = org.acc_id Where acc.acc_id = $acc_id";
    $sql_result = mysqli_query($con, $sql);

    if (mysqli_num_rows($sql_result) == 1) {
        $row = mysqli_fetch_array($sql_result);

        $_SESSION['org_id'] = $row['org_id'];
        $org_id = $row['org_id'];
        $acc_name = $row['acc_name'];
        $acc_email = $row['acc_email'];
        $role = $row['role'];
        $acc_join_date = $row['acc_join_date'];
        $org_name = $row['org_name'];
        $org_description = $row['org_description'];
        $org_email = $row['org_email'];
        $org_phone = $row['org_phone'];
        $org_website = $row['org_website'];
        $org_logo = $row['org_logo'];
        $established = $row['established'];
        $org_location = $row['org_location'];
        $org_vision = $row['org_vision'];
        $org_reviews = $row['org_reviews'];
    } else {
        echo "User data not found.";
    }
}

?>