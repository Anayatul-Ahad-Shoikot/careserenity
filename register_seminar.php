<?php
    include("./db_con.php");
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $seminar_id = $_POST['seminar_id'];
        $user_id = $_SESSION['acc_id'];

        // Check if the user is already registered
        $checkQuery = "SELECT * FROM participants WHERE seminar_id = $seminar_id AND user_id = $user_id";
        $checkResult = mysqli_query($con, $checkQuery);

        if (mysqli_num_rows($checkResult) == 0) {
            // Register the user for the seminar
            $registerQuery = "INSERT INTO participants (seminar_id, user_id) VALUES ($seminar_id, $user_id)";
            mysqli_query($con, $registerQuery);

            echo "You have successfully registered for the seminar!";
        } else {
            echo "You are already registered for this seminar.";
        }

        // Redirect back to the seminar page
        header('Location: U_seminar.php');
        exit;
    }
?>
