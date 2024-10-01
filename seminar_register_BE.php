<?php
    include_once './db_con.php';
    session_start();
    $user_id = $_GET['user_id'];
    $seminar_id = $_GET['seminar_id'];

    $query = "INSERT INTO seminar_participants (seminar_id, participant_id) VALUES ( $seminar_id, $user_id)";
    if(mysqli_query($con, $query)){
        $_SESSION['positive'] = "Registration successful !";
        header("Location: ./U_seminar.php");
        exit(0);
    } else {
        $_SESSION['positive'] = "Registration failed !";
        header("Location: ./U_seminar.php");
        exit(0);
    }