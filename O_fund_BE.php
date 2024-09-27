<?php
    include('./db_con.php');
    session_start();
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = mysqli_real_escape_string($con, $_POST['name']);
        $amount = mysqli_real_escape_string($con, $_POST['amount']);
        $duration = mysqli_real_escape_string($con, $_POST['duration']);
        $org_id = mysqli_real_escape_string($con, $_POST['org_id']);
        if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
            $img_tmp = $_FILES['img']['tmp_name'];
            $img_name = basename($_FILES['img']['name']);
            $img_path = './assets/'. $img_name;
            move_uploaded_file($img_tmp, $img_path);
        }
        $sql = "INSERT INTO funds (name, amount, duration, org_id, img) 
        VALUES ('$name', $amount, '$duration', $org_id,  '$img_name')";
        if (mysqli_query($con, $sql)) {
            $_SESSION['positive'] = "Fund deployed!";
            header('Location: ./O_funds.php');
        } else {
            $_SESSION['negative'] = "Fund deploy failed!.";
            header('Location: ./O_funds.php');
        }
        mysqli_close($con);
    }