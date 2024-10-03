<?php
include './db_con.php';
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = mysqli_real_escape_string($con, $_POST['title']);
    $no_of_vol = $_POST['No_of_vol'];
    $seminar_id = $_POST['seminar'];
    $service_type = mysqli_real_escape_string($con, $_POST['service_type']);
    $food_type = mysqli_real_escape_string($con, $_POST['food']);
    $org_id = $_POST['org_id'];
    $remuneration = null;
    if ($service_type === 'Paid') {
        $remuneration = (float) $_POST['remuneration'];
    }

    $query = "INSERT INTO volunteer_recruite (recruite_title, no_of_vol, seminar_id, service_type, remuneration, food_type, org_id) 
              VALUES ('$title', $no_of_vol, $seminar_id, '$service_type', $remuneration, '$food_type', $org_id)";
    if (mysqli_query($con, $query)) {
        $_SESSION['positive'] = "Volunteer recruite post create successfully!";
        header("Location: ./O_volunteer.php");
    } else {
        $_SESSION['negative'] = "Volunteer recruite post failed to upload!";
        header("Location: ./O_volunteer.php");
    }
}

mysqli_close($con);

header("Location: ./O_volunteer.php");
exit();

