<?php
    include("./db_con.php");
    session_start();
    if (isset($_GET['id'])) {
        $seminar_id = $_GET['id'];
        $deleteQuery = "DELETE FROM seminars WHERE seminar_id = $seminar_id";
        mysqli_query($con, $deleteQuery);
        $_SESSION['positive'] = "Seminar deleted successfully!";
    } else {
        $_SESSION['negative'] = "Seminar deletion failed!";
    }