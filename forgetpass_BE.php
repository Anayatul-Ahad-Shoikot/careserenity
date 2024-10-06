<?php
    include('./db_con.php');
    session_start();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $action = $_POST['action'];
        $acc_email = $_POST['acc_email'];
    
        if ($action == 'check_account') {
            $sql = "SELECT * FROM accounts WHERE acc_email = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("s", $acc_email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo "Account found";
            } else {
                echo "Account not found.";
            }
            $stmt->close();
        } elseif ($action == 'check_answer') {
            $security_question = $_POST['security_question'];
            $security_answer = $_POST['security_answer'];
            $sql = "SELECT * FROM accounts WHERE acc_email = ? AND question = ? AND answer = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param("sss", $acc_email, $security_question, $security_answer);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                echo "Answer correct";
            } else {
                echo "Incorrect answer.";
            }
            $stmt->close();
        } elseif ($action == 'update_password') {
            $new_pass = $_POST['new_pass'];
            $confirm_pass = $_POST['confirm_pass'];
            if ($new_pass === $confirm_pass) {
                $hashed_password = password_hash($new_pass, PASSWORD_DEFAULT);
                $update_sql = "UPDATE accounts SET acc_pass = ? WHERE acc_email = ?";
                $update_stmt = $con->prepare($update_sql);
                $update_stmt->bind_param("ss", $hashed_password, $acc_email);
                if ($update_stmt->execute()) {
                    $_SESSION['positive'] = "Password updated. Please login.";
                    header("Location: ./login.php");
                    exit(0);
                } else {
                    $_SESSION['negative'] = "Password update failed.";
                    header("Location: ./login.php");
                    exit(0);
                }
            } else {
                echo "Passwords do not match.";
            }
        }
    }

    $con->close();
?>
