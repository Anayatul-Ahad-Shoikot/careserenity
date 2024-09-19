<?php
    include("./db_con.php");
    session_start();

    if (isset($_GET['id'])) {
        $seminar_id = $_GET['id'];

        // Fetch the current visibility status
        $query = "SELECT visibility FROM seminars WHERE seminar_id = $seminar_id";
        $result = mysqli_query($con, $query);
        $seminar = mysqli_fetch_assoc($result);

        // Toggle the visibility
        $new_visibility = $seminar['visibility'] ? 0 : 1;

        // Update the seminar's visibility status
        $updateQuery = "UPDATE seminars SET visibility = $new_visibility WHERE seminar_id = $seminar_id";
        mysqli_query($con, $updateQuery);

        // Redirect back to the seminar list
        header('Location: O_seminar.php');
        exit;
    } else {
        echo "Invalid seminar ID.";
    }
?>
