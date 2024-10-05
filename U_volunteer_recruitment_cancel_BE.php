<?php
    session_start();
    include './db_con.php';

    $recruite_id = $_GET['id'];
    $acc_id = $_SESSION['acc_id'];

    $query = "SELECT user_id FROM user_list WHERE acc_id = $acc_id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

    // Check if the user is registered for the recruitment
    // $queryCheck = "SELECT COUNT(*) as participant_count FROM vol_participants WHERE recruite_id = $recruite_id AND user_id = $user_id";
    // $resultCheck = mysqli_query($con, $queryCheck);
    // $rowCheck = mysqli_fetch_assoc($resultCheck);
    // $exists = $rowCheck['participant_count'] > 0;

    // if ($exists) {
        // If the user is registered, delete their record
    $queryDelete = "DELETE FROM vol_participants WHERE recruite_id = $recruite_id AND user_id = $user_id";
    if (mysqli_query($con, $queryDelete)) {
        $_SESSION['positive'] = "You have successfully canceled your registration.";
    } else {
        $_SESSION['negative'] = "Failed to cancel registration.";
    }
    // } else {
    //     $_SESSION['negative'] = "You are not registered for this recruitment.";
    // }

    // Redirect back to the home page
    header('Location: ./U_home.php');
    exit();
?>
