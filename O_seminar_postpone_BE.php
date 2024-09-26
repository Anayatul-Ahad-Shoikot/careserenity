<?php
    include("./db_con.php");
    session_start();

    if (isset($_GET['id']) && isset($_GET['new_date'])) {
        $seminar_id = $_GET['id'];
        $new_date = $_GET['new_date'];
        $updateQuery = "UPDATE seminars SET seminar_date = '$new_date', isPostpone = 1 WHERE seminar_id = $seminar_id";
        mysqli_query($con, $updateQuery);
        header('Location: ./O_seminar.php');
        exit;
    }   else {
        echo "Invalid seminar ID.";
    }
