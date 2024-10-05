<?php
    session_start();
    include './db_con.php';
    if (isset($_POST['id'])) {
        $recruitmentId = $_POST['id'];
        $query = "UPDATE volunteer_recruite SET isClosed = 1 WHERE recruite_id = $recruitmentId";
        if (mysqli_query($con, $query)) {
            $_SESSION['positive'] = "Recruitment has been closed !";
        } else {
            $_SESSION['negative'] = "Failed to close the recruitment. Error: " . mysqli_error($con);
        }
    } else {
        $_SESSION['negative'] = "Invalid recruitment ID.";
    }
    header('Location: ./o_volunteer.php');
    exit();

