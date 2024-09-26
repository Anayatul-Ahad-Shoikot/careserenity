<?php
    include('./db_con.php');
    session_start();
    $acc_id = $_SESSION['acc_id'];
    $sql = "SELECT org_id FROM org_list WHERE acc_id = $acc_id";
    $sql_result = mysqli_query($con, $sql);
    if (mysqli_num_rows($sql_result) == 1) {
        $row = mysqli_fetch_array($sql_result);
        $org_id = $row['org_id'];
    }
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $seminar_date = mysqli_real_escape_string($con, $_POST['seminar_date']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $guest = mysqli_real_escape_string($con, $_POST['guest']);
    $type = mysqli_real_escape_string($con, $_POST['type']);
    $location = ($type === 'offline') ? mysqli_real_escape_string($con, $_POST['location']) : null; 
    if (isset($_FILES['banner']) && $_FILES['banner']['error'] === UPLOAD_ERR_OK) {
        $banner_tmp = $_FILES['banner']['tmp_name'];
        $banner_name = basename($_FILES['banner']['name']);
        $banner_path = './assets/'. $banner_name;
        move_uploaded_file($banner_tmp, $banner_path);
    }
    $sql = "INSERT INTO seminars (title, banner, description, seminar_date, subject, guest, type, location, org_id ) 
            VALUES ('$title', '$banner_name', '$description', '$seminar_date', '$subject', '$guest', '$type', '$location', $org_id)";
    if (mysqli_query($con, $sql)) {
        $_SESSION['positive'] = "200: Seminar created successfully!";
        header('Location: ./O_seminar.php');
    } else {
        $_SESSION['negative'] = "404: Seminar creation failed !";
        header('Location: ./O_seminar.php');
    }
    mysqli_close($con);
