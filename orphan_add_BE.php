<?php

    include('db_con.php');
    session_start();

    $acc_id = $_SESSION['acc_id'];

    $query1 = "SELECT org_id FROM org_list WHERE acc_id = $acc_id";
    $result1 = mysqli_query($con, $query1);
    $row1 = mysqli_fetch_assoc($result1);
    $org_id = $row1['org_id'];

    if(isset($_SESSION['acc_id']) && $_SESSION['role'] == "org") {
        
        if (isset($_POST['Register'])) {
            
            $guardian_name = $_POST['guardian_name'];
            $guardian_contact = $_POST['guardian_contact'];
            $guardian_location = $_POST['guardian_location'];
            $query2 = "INSERT INTO local_orphan_guardian (guardian_name, guardian_contact, guardian_location) VALUES ('$guardian_name','$guardian_contact','$guardian_location')";
            mysqli_query($con, $query2);
            $guardian_id = mysqli_insert_id($con);

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $religion = $_POST['religion'];
            $date_of_birth = $_POST['date_of_birth'];
            $family_status = $_POST['family_status'];
            $physical_condition = $_POST['physical_condition'];
            $education_level = $_POST['education_level'];
            $medical_history = $_POST['medical_history'];
            $hobby = $_POST['hobby'];
            $favorite_food = $_POST['favorite_food'];
            $favorite_game = $_POST['favorite_game'];
            $skills = $_POST['skills'];
            $dreams = $_POST['dreams'];
            $problems = $_POST['problems'];
            $time = date("Y-m-d");
            $other_comments = $_POST['other_comments'];
            $image_name = $_FILES["image"]["name"];
            $image_tmp_name = $_FILES["image"]["tmp_name"];
            $orphan_name = preg_replace("/[^a-zA-Z0-9]/", "", $last_name);
            $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $new_image_name = $orphan_name . "_" . uniqid() . "." . $file_extension;
            $image_path = "../UserImage/childpic/" . $new_image_name;
            move_uploaded_file($image_tmp_name, $image_path);

            $query = "INSERT INTO orphan_list (org_id, guardian_id, first_name, last_name, age, gender, religion, date_of_birth, since, family_status, physical_condition, education_level, medical_history, hobby, favorite_food, favorite_game, skills, dreams, problems, other_comments, orphan_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = mysqli_prepare($con, $query);

            if ($stmt) {
                mysqli_stmt_bind_param($stmt, "iississssssssssssssss", $org_id ,$guardian_id, $first_name, $last_name, $age, $gender, $religion, $date_of_birth, $time, $family_status, $physical_condition, $education_level, $medical_history, $hobby, $favorite_food, $favorite_game, $skills, $dreams, $problems, $other_comments, $new_image_name);
                if (mysqli_stmt_execute($stmt)) {
                    $_SESSION['positive'] = "Orphan has been registered";
                    header("Location: /FrontEnd/loggedIn/organizationpage/orphan.php");
                    exit(0);
                } else {
                    $_SESSION['negative'] = "Orphan registration failed";
                    header("Location: /FrontEnd/loggedIn/organizationpage/orphan.php");
                }
                mysqli_stmt_close($stmt);
            } else {
                $_SESSION['negative'] = "Orphan registration failed";
                header("Location: /FrontEnd/loggedIn/organizationpage/orphan.php");
            }
            mysqli_close($con);
        }
    }   else {
        $_SESSION['negative'] = "please login first";
        header("Location: /FrontEnd/loggedOut/login.php");
        exit(0);
    }
?>