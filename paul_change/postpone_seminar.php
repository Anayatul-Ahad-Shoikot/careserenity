<?php
    include("./db_con.php");
    session_start();

    if (isset($_GET['id'])) {
        $seminar_id = $_GET['id'];

        // Fetch the current seminar details
        $query = "SELECT * FROM seminars WHERE seminar_id = $seminar_id";
        $result = mysqli_query($con, $query);
        $seminar = mysqli_fetch_assoc($result);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle postponing the seminar (updating the date)
            $new_date = $_POST['new_date'];

            // Update the seminar date
            $updateQuery = "UPDATE seminars SET date = '$new_date' WHERE seminar_id = $seminar_id";
            mysqli_query($con, $updateQuery);

            // Redirect back to the seminar list or show success message
            header('Location: O_seminar.php');
            exit;
        }
    } else {
        echo "Invalid seminar ID.";
    }
?>

<!-- Postpone Seminar Form -->
<form method="POST">
    <label for="new_date">New Date:</label>
    <input type="date" name="new_date" required>
    <button type="submit">Postpone Seminar</button>
</form>