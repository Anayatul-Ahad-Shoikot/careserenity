<?php
    include("./db_con.php");
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $participant_id = $_POST['participant_id'];

        // Delete the registration record
        $cancelQuery = "DELETE FROM participants WHERE participant_id = $participant_id";
        mysqli_query($con, $cancelQuery);

        echo "You have successfully canceled your registration.";

        // Redirect back to the seminar page
        header('Location: U_seminar.php');
        exit;
    }
?>