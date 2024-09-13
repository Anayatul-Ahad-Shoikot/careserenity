<?php

include('./db_con.php');
session_start();
if (!isset($_SESSION['acc_id']) && !isset($_SESSION['role'])) {
    $_SESSION['negative'] = "Warning: Please login first.";
    header("Location: ./login.php");
    exit();
} else {
    if (isset($_POST['update'])) {
        $user_id = $_SESSION['user_id'];
        if (isset($_POST['user_name']) && !empty($_POST['user_name'])) {
            $user_name = $_POST['user_name'];
            $SQL = "UPDATE user_list SET user_name = ? WHERE user_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $user_name, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['user_birth']) && !empty($_POST['user_birth'])) {
            $user_birth = $_POST['user_birth'];
            $SQL = "UPDATE user_list SET user_birth = ? WHERE user_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $user_birth, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['user_contact']) && !empty($_POST['user_contact'])) {
            $user_contact = $_POST['user_contact'];
            $SQL = "UPDATE user_list SET user_contact = ? WHERE user_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $user_contact, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['user_gender']) && !empty($_POST['user_gender'])) {
            $user_gender = $_POST['user_gender'];
            $SQL = "UPDATE user_list SET user_gender = ? WHERE user_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $user_gender, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['user_NID']) && !empty($_POST['user_NID'])) {
            $user_NID = $_POST['user_NID'];
            $SQL = "UPDATE user_list SET user_NID = ? WHERE user_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $user_NID, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['user_website']) && !empty($_POST['user_website'])) {
            $user_website = $_POST['user_website'];
            $SQL = "UPDATE user_list SET user_website = ? WHERE user_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $user_website, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['user_job']) && !empty($_POST['user_job'])) {
            $user_job = $_POST['user_job'];
            $SQL = "UPDATE user_list SET user_job = ? WHERE user_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $user_job, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['user_location']) && !empty($_POST['user_location'])) {
            $user_location = $_POST['user_location'];
            $SQL = "UPDATE user_list SET user_location = ? WHERE user_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $user_location, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['user_address']) && !empty($_POST['user_address'])) {
            $user_address = $_POST['user_address'];
            $SQL = "UPDATE user_list SET user_address = ? WHERE user_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $user_address, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])) {
            $image_name = $_FILES["image"]["name"];
            $image_tmp_name = $_FILES["image"]["tmp_name"];
            $sql = "SELECT user_name FROM user_list WHERE user_id = $user_id";
            $row = mysqli_fetch_assoc(mysqli_query($con, $sql));
            $user_name = $row['user_name'];
            $user_name = preg_replace("/[^a-zA-Z0-9]/", "", $user_name);
            $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $new_image_name = $user_name . "_" . substr(md5(uniqid()), 0, 5) . "." . $file_extension;
            $image_path = "./assets/" . $new_image_name;
            move_uploaded_file($image_tmp_name, $image_path);
            $SQL = "UPDATE user_list SET user_image = '$new_image_name' WHERE user_id = $user_id LIMIT 1";
            mysqli_query($con, $SQL);
        }
        $_SESSION['positive'] = "Profile Updated successfully";
        header("Location: ./U_profile.php");
    } else {
        $_SESSION['negative'] = "Prfile update failed";
        header("Location: ./U_profile.php");
    }
}
mysqli_close($con);
