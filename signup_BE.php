<?php
    include('./db_con.php');
    session_start();

    if (isset($_POST['signup_btn'])) {

        $acc_name = $_POST['acc_name'];
        $acc_email = $_POST['acc_email'];
        $acc_pass = $_POST['acc_pass'];
        $confirm_pass = $_POST['confirm_pass'];
        $role = $_POST['role'];
        $question = $_POST['question'];
        $answer = $_POST['answer'];
        $date = date("Y-m-d");

        $Name_Check_Query = "SELECT acc_name FROM accounts WHERE acc_name = '$acc_name' LIMIT 1";
        $Name_Check_Query_Result = mysqli_query($con, $Name_Check_Query);

        if (mysqli_num_rows($Name_Check_Query_Result) > 0) {
            $_SESSION['negative'] = "Warning: Username already exist.";
            header("Location: ./signup.php");
            exit(0);
        }

        $Email_Check_Query = "SELECT acc_email FROM accounts WHERE acc_email = '$acc_email' LIMIT 1";
        $Email_Check_Query_Result = mysqli_query($con, $Email_Check_Query);
        if (mysqli_num_rows($Email_Check_Query_Result) > 0) {
            $_SESSION['negative'] = "Warning: Email already exist.";
            header("Location: ./signup.php");
            exit(0);
        }

        if ($acc_pass !== $confirm_pass) {
            $_SESSION['negative'] = "Warning: Password doesn't match";
            header("Location: ./signup.php");
            exit(0);
        }

        $hashed_password = password_hash($acc_pass, PASSWORD_DEFAULT);
        $SignUp_Query = "INSERT INTO accounts (acc_name, acc_pass, acc_email, role, acc_join_date, question, answer) VALUES ('$acc_name', '$hashed_password', '$acc_email', '$role', '$date', '$question', '$answer')";
        mysqli_query($con, $SignUp_Query);
        $acc_id = mysqli_insert_id($con);

        if ($role == "user") {
            $SignUp_Query_1 = "INSERT INTO user_list (acc_id, user_name, user_birth, user_gender, user_job, user_location, user_image) VALUES ('$acc_id', 'Set Your Fullname', '00-00-0000', 'N/A', 'N/A', 'Bangladesh','user.png')";
            if (mysqli_query($con, $SignUp_Query_1)) {
                $_SESSION['positive'] = "SignUp Successfull! Login to continue.";
                header("Location: ./login.php");
                exit(0);
            } else {
                $_SESSION['negative'] = "Warning: Specific Role insertion failed.";
                header("Location: ./login.php");
                exit(0);
            }
        } else {
            $SignUp_Query_2 = "INSERT INTO org_list (acc_id, org_name, org_description, established, org_vision, org_location, org_logo, org_reviews) VALUES ('$acc_id', 'Set Your Organization name', 'N/A', '00-00-0000', 'N/A', 'Bangladesh','user.png', '0.0')";
            if (mysqli_query($con, $SignUp_Query_2)) {
                $_SESSION['positive'] = "SignUp Successfull! Login to continue.";
                header("Location: ./login.php");
                exit(0);
            } else {
                $_SESSION['negative'] = "Warning: Specific Role insertion failed.";
                header("Location: ./login.php");
                exit(0);
            }
        }
    }

    mysqli_close($con);
