<?php
include('./db_con.php');
session_start();

if (isset($_POST['login_btn'])) {
    $acc_email = $_POST['acc_email'];
    $entered_acc_pass = $_POST['acc_pass'];

    $Name_Check_Query = "SELECT * FROM accounts WHERE acc_email = '$acc_email'";
    $Name_Check_Query_Result = mysqli_query($con, $Name_Check_Query);

    if (mysqli_num_rows($Name_Check_Query_Result) == 1) {
        $row = mysqli_fetch_array($Name_Check_Query_Result);
        $stored_hashed_acc_pass = $row['acc_pass'];

        if (password_verify($entered_acc_pass, $stored_hashed_acc_pass)) {
            $_SESSION['acc_id'] = $row['acc_id'];
            $_SESSION['role'] = $row['role'];
            switch ($_SESSION['role']) {
                case 'admin':
                    header("Location: #");
                    exit(0);
                case 'org':
                    $_SESSION['positive'] = "Welcome back, $acc_email ";
                    header("Location: ./O_home.php");
                    exit(0);
                case 'user':
                    $_SESSION['positive'] = "Welcome back, $acc_email !";
                    header("Location: ./U_home.php");
                    exit(0);
            }
        } else {
            $_SESSION['negative'] = "Warning: Invalid password";
            header("Location: ./login.php");
            exit(0);
        }
    } else {
        $_SESSION['negative'] = "Warning: Invalid username";
        header("Location: ./login.php");
        exit(0);
    }
} else {
    $_SESSION['negative'] = "Warning: Enter username & password";
    header("Location: ./login.php");
    exit(0);
}

mysqli_close($con);
