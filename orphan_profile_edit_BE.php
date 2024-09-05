<?php
    include('db_con.php');
    session_start();
    if (isset($_POST['update'])) {

        $orphan_id = $_POST['orphan_id'];
        $guardian_id = $_POST['guardian_id'];

        if (isset($_POST['first_name']) && !empty($_POST['first_name'])) {
            $first_name = $_POST['first_name'];
            $SQL = "UPDATE orphan_list SET first_name = ? WHERE orphan_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $first_name, $orphan_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['last_name']) && !empty($_POST['last_name'])) {
            $last_name = $_POST['last_name'];
            $SQL = "UPDATE orphan_list SET last_name = ? WHERE orphan_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $last_name, $orphan_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['age']) && !empty($_POST['age'])) {
            $age = $_POST['age'];
            $SQL = "UPDATE orphan_list SET age = ? WHERE orphan_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "ii", $age, $orphan_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

        }
        if (isset($_POST['guardian_location']) && !empty($_POST['guardian_location'])) {
            $guardian_location = $_POST['guardian_location'];
            $SQL = "UPDATE local_orphan_guardian SET guardian_location = ? WHERE guardian_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $guardian_location, $guardian_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

        }
        if (isset($_POST['guardian_name']) && !empty($_POST['guardian_name'])) {
            $guardian_name = $_POST['guardian_name'];
            $SQL = "UPDATE local_orphan_guardian SET guardian_name = ? WHERE guardian_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $guardian_name, $guardian_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['guardian_contact']) && !empty($_POST['guardian_contact'])) {
            $guardian_contact = $_POST['guardian_contact'];
            $SQL = "UPDATE local_orphan_guardian SET guardian_contact = ? WHERE guardian_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $guardian_contact, $guardian_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['gender']) && !empty($_POST['gender'])) {
            $gender = $_POST['gender'];
            $SQL = "UPDATE orphan_list SET gender = ? WHERE orphan_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $gender, $orphan_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['religion']) && !empty($_POST['religion'])) {
            $religion = $_POST['religion'];
            $SQL = "UPDATE orphan_list SET religion = ? WHERE orphan_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $religion, $orphan_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['date_of_birth']) && !empty($_POST['date_of_birth'])) {
            $date_of_birth = $_POST['date_of_birth'];
            $SQL = "UPDATE orphan_list SET date_of_birth = ? WHERE orphan_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $date_of_birth, $orphan_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);      
        }
        if (isset($_POST['family_status']) && !empty($_POST['family_status'])) {
            $family_status = $_POST['family_status'];
            $SQL = "UPDATE orphan_list SET family_status = ? WHERE orphan_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $family_status, $orphan_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['physical_condition']) && !empty($_POST['physical_condition'])) {
            $physical_condition = $_POST['physical_condition'];
            $SQL = "UPDATE orphan_list SET physical_condition = ? WHERE orphan_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $physical_condition, $orphan_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['education_level']) && !empty($_POST['education_level'])) {
            $education_level = $_POST['education_level'];
            $SQL = "UPDATE orphan_list SET education_level = ? WHERE orphan_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $education_level, $orphan_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['medical_history']) && !empty($_POST['medical_history'])) {
            $medical_history = $_POST['medical_history'];
            $SQL = "UPDATE orphan_list SET medical_history = ? WHERE orphan_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $medical_history, $orphan_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['hobby']) && !empty($_POST['hobby'])) {
            $hobby = $_POST['hobby'];
            $SQL = "UPDATE orphan_list SET hobby = ? WHERE orphan_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $hobby, $orphan_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['favorite_food']) && !empty($_POST['favorite_food'])) {
            $favorite_food = $_POST['favorite_food'];
            $SQL = "UPDATE orphan_list SET favorite_food = ? WHERE orphan_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $favorite_food, $orphan_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['favorite_game']) && !empty($_POST['favorite_game'])) {
            $favorite_game = $_POST['favorite_game'];
            $SQL = "UPDATE orphan_list SET favorite_game = ? WHERE orphan_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $favorite_game, $orphan_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['skills']) && !empty($_POST['skills'])) {
            $skills = $_POST['skills'];
            $SQL = "UPDATE orphan_list SET skills = ? WHERE orphan_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $skills, $orphan_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['dreams']) && !empty($_POST['dreams'])) {
            $dreams = $_POST['dreams'];
            $SQL = "UPDATE orphan_list SET dreams = ? WHERE orphan_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $dreams, $orphan_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['problems']) && !empty($_POST['problems'])) {
            $problems = $_POST['problems'];
            $SQL = "UPDATE orphan_list SET problems = ? WHERE orphan_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $problems, $orphan_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_POST['other_comments']) && !empty($_POST['other_comments'])) {
            $other_comments = $_POST['other_comments'];
            $SQL = "UPDATE orphan_list SET other_comments = ? WHERE orphan_id = ? LIMIT 1";
            $stmt = mysqli_prepare($con, $SQL);
            mysqli_stmt_bind_param($stmt, "si", $other_comments, $orphan_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        if (isset($_FILES["image"]["name"]) && !empty($_FILES["image"]["name"])) {
            $image_name = $_FILES["image"]["name"];
            $image_tmp_name = $_FILES["image"]["tmp_name"];
            $sql = "SELECT first_name FROM orphan_list WHERE orphan_id = $orphan_id";
            $row = mysqli_fetch_assoc(mysqli_query($con, $sql));
            $orphan_name = $row['first_name'];
            $orphan_name = preg_replace("/[^a-zA-Z0-9]/", "", $orphan_name);
            $file_extension = pathinfo($image_name, PATHINFO_EXTENSION);
            $new_image_name = $orphan_name . "_" . uniqid() . "." . $file_extension;
            $image_path = "../UserImage/childpic/" . $new_image_name;
            move_uploaded_file($image_tmp_name, $image_path);
            $SQL="UPDATE orphan_list SET orphan_image = '$new_image_name' WHERE orphan_id = $orphan_id LIMIT 1";
            mysqli_query($con, $SQL);
        }
        $_SESSION['positive'] = "Orphan profile updated successfully.";
        header("Location: /FrontEnd/loggedIn/organizationpage/orphan_profile.php?orphan_id=$orphan_id");
        } 
        
        
        else {
            $_SESSION['negative'] = "Failed to update orphan profile.";
            header("Location: /FrontEnd/loggedIn/organizationpage/orphan_profile.php?orphan_id=$orphan_id");
        }
    mysqli_close($con);
?>