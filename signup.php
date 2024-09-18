<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Signup</title>
    <link rel="stylesheet" href="./css/colors.css">
    <link rel="stylesheet" href="./css/login.css">
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

    <div class="login-container">
        <form action="./signup_BE.php" method="POST">
            <h1>SignUp</h1>
            <input type="text" name="acc_email" required placeholder="Account Email">
            <input type="password" name="acc_pass" required placeholder="Account Password">
            <input type="password" name="confirm_pass" required placeholder="Confirm password">
            <div class="user-type">
                <label>Account type:</label>
                <select name="role">
                    <option value="" selected disabled>Select your account type</option>
                    <option value="user">User</option>
                    <option value="org">Organization</option>
                </select>
            </div>
            <div class="user-type">
                <label>Security question:</label>
                <select name="question">
                    <option value="" selected disabled>Select a question</option>
                    <option value="What was your childhood nickname?">What was your childhood nickname?</option>
                    <option value="What is your favorite book?">What is your favorite book?</option>
                    <option value="What was the name of your first pet?">What was the name of your first pet?</option>
                    <option value="What is your favorite movie?">What is your favorite movie?</option>
                    <option value="What was your first job?">What was your first job?</option>
                    <option value="What was your biggest lost?">What was your biggest lost?</option>
                    <option value="What is the last name of your best childhood friend?">What is the last name of your best childhood friend?</option>
                    <option value="What is your favourite faculty name?">What is your favourite faculty name?</option>
                </select>
            </div>
            <input type="text" name="answer" required placeholder="Your answer">
            <button type="submit" name="signup_btn" id="button-30">SignUp</button>
        </form>
        <p class="signup">Already have an account?<a id="signup" href="./login.php">Login</a></p>
        <span><a href="./index.php" class="goback">Go Back</a></span>
    </div>
</body>
</body>

</html>