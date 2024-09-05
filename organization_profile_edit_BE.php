<?php
include('db_con.php');
session_start();

if (!isset($_SESSION['acc_id']) && !isset($_SESSION['role'])) {
    $_SESSION["negative"] = "Warning. You have to login first";
    header("Location: /FrontEnd/loggedOut/login.php");
    exit();
} else {
    if (isset($_POST['update'])) {
        $org_id = $_SESSION['org_id'];

        if (isset($_POST['org_name']) && !empty($_POST['org_name'])) {
            $org_name = $_POST['org_name'];
            $SQL = "UPDATE org_list SET org_name = ? WHERE org_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $org_name, $org_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['org_email']) && !empty($_POST['org_email'])) {
            $org_email = $_POST['org_email'];
            $SQL = "UPDATE org_list SET org_email = ? WHERE org_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $org_email, $org_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['org_phone']) && !empty($_POST['org_phone'])) {
            $org_phone = $_POST['org_phone'];
            $SQL = "UPDATE org_list SET org_phone = ? WHERE org_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $org_phone, $org_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['established']) && !empty($_POST['established'])) {
            $established = $_POST['established'];
            $SQL = "UPDATE org_list SET established = ? WHERE org_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $established, $org_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['org_description']) && !empty($_POST['org_description'])) {
            $org_description = $_POST['org_description'];
            $SQL = "UPDATE org_list SET org_description = ? WHERE org_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $org_description, $org_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['org_website']) && !empty($_POST['org_website'])) {
            $org_website = $_POST['org_website'];
            $SQL = "UPDATE org_list SET org_website = ? WHERE org_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $org_website, $org_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['org_location']) && !empty($_POST['org_location'])) {
            $org_location = $_POST['org_location'];
            $SQL = "UPDATE org_list SET org_location = ? WHERE org_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $org_location, $org_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['org_vision']) && !empty($_POST['org_vision'])) {
            $org_vision = $_POST['org_vision'];
            $SQL = "UPDATE org_list SET org_vision = ? WHERE org_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $org_vision, $org_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])) {
            $image_name = $_FILES["image"]["name"];
            $image_tmp_name = $_FILES["image"]["tmp_name"];
            $sql = "SELECT org_name FROM org_list WHERE org_id = $org_id";
            $row = mysqli_fetch_assoc(mysqli_query($con, $sql));
            $org_name = $row['org_name'];
            $org_name = preg_replace("/[^a-zA-Z0-9]/", "", $org_name);
            $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $new_image_name = $org_name . "_" . uniqid() . "." . $file_extension;
            $image_path = "../UserImage/accountPic/" . $new_image_name;
            move_uploaded_file($image_tmp_name, $image_path);
            $SQL = "UPDATE org_list SET org_logo = '$new_image_name' WHERE org_id = $org_id LIMIT 1";
            mysqli_query($con, $SQL);
        }
        $_SESSION['positive'] = "Profile Updated successfully";
        header("Location: /FrontEnd/loggedIn/organizationpage/profile.php");
    } else {
        $_SESSION['negative'] = "Profile update failed";
        header("Location: /FrontEnd/loggedIn/organizationpage/profile.php");
    }
}
mysqli_close($con);
