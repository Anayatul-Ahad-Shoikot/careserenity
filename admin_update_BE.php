<?php
    include('./db_con.php');
    session_start();

    if (isset($_SESSION['acc_id']) && isset($_SESSION['role'])) {
        $acc_id = $_SESSION['acc_id'];
        $role = $_SESSION['role'];

        if (isset($_POST['submit1'])) {
                if (isset($_POST['acc_email']) && !empty($_POST['acc_email'])) {
                    $acc_email = $_POST['acc_email'];
                    $SQL = "UPDATE accounts SET acc_email = ? WHERE acc_id = ? LIMIT 1";
                    $stmt = mysqli_prepare($con, $SQL);
                    mysqli_stmt_bind_param($stmt, "si", $acc_email, $acc_id);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                }
                if (isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])) {
                    $random_number = rand(100, 999);
                    $image_name = "admin_" . $random_number . ".jpg";
                    $image_tmp_name = $_FILES["image"]["tmp_name"];
                    $image_path = "./assets/" . $image_name;
                    move_uploaded_file($image_tmp_name, $image_path);
                    $SQL2 = "UPDATE admin_list SET admin_image = '$image_name' WHERE acc_id = $acc_id LIMIT 1";
                    mysqli_query($con, $SQL2);
                }
                if (isset($_POST['admin_contact']) && !empty($_POST['admin_contact'])) {
                    $admin_contact = $_POST['admin_contact'];
                    $SQL = "UPDATE admin_list SET admin_contact = ? WHERE acc_id = ? LIMIT 1";
                    $stmt = mysqli_prepare($con, $SQL);
                    mysqli_stmt_bind_param($stmt, "si", $admin_contact, $acc_id);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                }

                if (isset($_POST['admin_name']) && !empty($_POST['admin_name'])) {
                    $admin_name = $_POST['admin_name'];
                    $SQL = "UPDATE admin_list SET admin_name = ? WHERE acc_id = ? LIMIT 1";
                    $stmt = mysqli_prepare($con, $SQL);
                    mysqli_stmt_bind_param($stmt, "si", $admin_name, $acc_id);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);
                }
                $_SESSION['notification-1'] = "Update successfully";
                header("Location: ./admin_profile.php");
            } else {
                $_SESSION['notification-2'] = "Error to update information";
                header("Location: ./admin_profile.php");
            }
        }    
    mysqli_close($con);
?>