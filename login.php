<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Login</title>
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
    <div class="positive">
        <?php
        if (isset($_SESSION['positive'])) {
            echo "<h5>" . $_SESSION['positive'] . "</h5>";
            unset($_SESSION['positive']);
        }
        ?>
    </div>

    <div class="login-container">
        <form action="./login_BE.php" method="POST">
            <h1>LogIn</h1>
            <input type="text" name="acc_name" placeholder="Account Name" required>
            <input type="password" name="acc_pass" placeholder="Password" required>
            <button type="submit" name="login_btn" id="button-30">LogIn</button>
        </form>
        <p class="forgetPass"><a href="./forgetpassword.php">Forget password?</a></p>
        <p class="signup">Don't have an account?<a id="signup" href="./signup.php">Create new</a></p>
        <span><a href="./index.php" class="goback">Go Back</a></span>
    </div>

</body>

</html>