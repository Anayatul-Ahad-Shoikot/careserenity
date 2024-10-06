<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Forget password</title>
    <link rel="stylesheet" href="./css/colors.css">
    <link rel="stylesheet" href="./css/login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <div class="negative">
        <?php
        if (isset($_SESSION['negative'])) {
            echo "<h5>" . $_SESSION['negative'] . "</h5>";
            unset($_SESSION['negative']);
        }
        ?>
    </div>
    <div class="positive">
        <?php
        if (isset($_SESSION['positive'])) {
            echo "<h5>" . $_SESSION['positive'] . "</h5>";
            unset($_SESSION['positive']);
        }
        ?>
    </div>

    <div class="login-container">
        <div class="container" id="form-container">
            <div class="slide">
                <form id="phase1-form">
                    <label>Account verification: </label>
                    <input type="text" name="acc_email" id="acc_email" placeholder="Account email" required>
                    <button type="button" id="check-account">Next</button>
                </form>
            </div>
            <div class="slide hidden">
                <form id="phase2-form">
                    <label>Security question verification:</label>
                    <div class="user-type">
                        <select name="question" id="security_question">
                            <option value="" selected disabled>Select your question</option>
                            <option value="What was your childhood nickname?">What was your childhood nickname?</option>
                            <option value="What is your favorite book?">What is your favorite book?</option>
                            <option value="What was the name of your first pet?">What was the name of your first pet?</option>
                            <option value="What is your favorite movie?">What is your favorite movie?</option>
                            <option value="What was your first job?">What was your first job?</option>
                            <option value="What was your biggest loss?">What was your biggest loss?</option>
                            <option value="What is the last name of your best childhood friend?">What is the last name of your best childhood friend?</option>
                            <option value="What is your favourite faculty name?">What is your favourite faculty name?</option>
                        </select>
                    </div>
                    <input type="text" name="security_answer" id="security_answer" placeholder="Answer" required>
                    <button type="button" id="check-answer">Next</button>
                </form>
            </div>
            <div class="slide hidden">
                <form id="password-form" action="./forgetpass_BE.php" method="POST">
                    <label>Set new password:</label>
                    <input type="password" name="new_pass" id="new_pass" placeholder="Enter new password" required>
                    <input type="password" name="confirm_pass" id="confirm_pass" placeholder="Enter password again" required>
                    <input type="hidden" name="acc_email" id="acc_email_hidden">
                    <input type="hidden" name="action" value="update_password">
                    <button type="submit" name="update_btn">Update Password</button>
                </form>
            </div>
        </div>
        <span><a href="./login.php" class="goback">Go Back</a></span>
    </div>

    <script src="./js/forgetpass.js"></script>
</body>

</html>