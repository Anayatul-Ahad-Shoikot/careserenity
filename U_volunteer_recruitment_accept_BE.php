<?php 
    session_start();
    include './db_con.php';
    $recruite_id = $_GET['id'];
    $maxParticipants = $_GET['total_p'];
    $acc_id = $_SESSION['acc_id'];

    $query = "SELECT user_id FROM user_list WHERE acc_id = $acc_id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];

    $queryCheck = "SELECT COUNT(*) as participant_count FROM vol_participants WHERE recruite_id = $recruite_id AND user_id = $user_id";
    $resultCheck = mysqli_query($con, $queryCheck);
    $rowCheck = mysqli_fetch_assoc($resultCheck);
    $exists = $rowCheck['participant_count'] > 0;


    $queryCheck = "SELECT COUNT(*) as isParticipant
                    FROM seminar_participants AS sp
                    INNER JOIN volunteer_recruite AS vr ON vr.seminar_id = sp.seminar_id
                    WHERE sp.participant_id = $user_id";
    $resultCheck = mysqli_query($con, $queryCheck);
    $rowCheck = mysqli_fetch_assoc($resultCheck);
    $isParticipant = $rowCheck['isParticipant'] > 0;


    $queryTotal = "SELECT COUNT(*) as total_participants FROM vol_participants WHERE recruite_id = $recruite_id";
    $resultTotal = mysqli_query($con, $queryTotal);
    $rowTotal = mysqli_fetch_assoc($resultTotal);
    $totalParticipants = $rowTotal['total_participants'];

    if($isParticipant == 0){
        if ($totalParticipants < $maxParticipants) {
            if ($exists == 0) {
                $query1 = "INSERT INTO vol_participants (recruite_id, user_id) VALUES ($recruite_id, $user_id)";
                if (mysqli_query($con, $query1)) {
                    $_SESSION['positive'] = "Registration successful!";
                    header('Location: ./U_home.php');
                    exit();
                } else {
                    $_SESSION['negative'] = "Failed to register.";
                    header('Location: ./U_home.php');
                    exit();
                }
            } else {
                $_SESSION['negative'] = "You are already registered.";
                header('Location: ./U_home.php');
                exit();
            }
        } else {
            $_SESSION['negative'] = "Maximum participants reached.";
            header('Location: ./U_home.php');
            exit();
        }
    } else {
        $_SESSION['negative'] = "Sorry, participants can't be volunteer.";
        header('Location: ./U_home.php');
        exit();
    }