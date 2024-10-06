<?php
include("./db_con.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $seminar_id = $_POST['seminar_id'];
    $seminar_query = "SELECT * FROM seminars WHERE seminar_id = ?";
    $stmt = $con->prepare($seminar_query);
    $stmt->bind_param('i', $seminar_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $current_seminar = $result->fetch_assoc();
    $stmt->close();
    

    if (isset($_POST['update'])){
        $title = !empty($_POST['title']) ? $_POST['title'] : $current_seminar['title'];
        $description = !empty($_POST['description']) ? $_POST['description'] : $current_seminar['description'];
        $subject = !empty($_POST['subject']) ? $_POST['subject'] : $current_seminar['subject'];
        $guest = !empty($_POST['guest']) ? $_POST['guest'] : $current_seminar['guest'];
        $type = !empty($_POST['type']) ? $_POST['type'] : $current_seminar['type'];
        $location = !empty($_POST['location']) ? $_POST['location'] : $current_seminar['location'];
        $seminar_date = !empty($_POST['seminar_date']) ? $_POST['seminar_date'] : $current_seminar['seminar_date'];
        
        $old_img = $current_seminar['banner'];
        if (isset($_FILES['img']['name']) && $_FILES['img']['error'] == 0) {
            $new_img = "Seminar_Banner_" . $seminar_id . "." . pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
            
            if ($old_img !== $new_img) {
                move_uploaded_file($_FILES['img']['tmp_name'], "./assets/" . $new_img);
                $old_img = $new_img;
            }
        }
        $update_query = "UPDATE seminars SET title=?, description=?, subject=?, guest=?, type=?, location=?, seminar_date=?, banner=? WHERE seminar_id=?";
        $stmt = $con->prepare($update_query);
        $stmt->bind_param('ssssssssi', $title, $description, $subject, $guest, $type, $location, $seminar_date, $old_img, $seminar_id);
        
        if ($stmt->execute()) {
            $_SESSION['positive'] = "Seminar details have been updated.";
        } else {
            $_SESSION['negative'] = "Failed to update seminar!";
        }
        $stmt->close();
        header("Location: ./O_seminar_edit.php?id={$seminar_id}");
        exit();
    }

    if (isset($_POST['hide'])) {
        $hide_query = "UPDATE seminars SET visibility = 1 WHERE seminar_id = ?";
        $stmt = $con->prepare($hide_query);
        $stmt->bind_param('i', $seminar_id);
        if ($stmt->execute()) {
            $_SESSION['positive'] = "Seminar has been hidden!";
        } else {
            $_SESSION['negative'] = "Failed to hide the seminar!";
        }
        $stmt->close();
        header("Location: ./O_seminar_edit.php?id={$seminar_id}");
        exit();
    }

    if (isset($_POST['Public'])) {
        $public_query = "UPDATE seminars SET visibility = 0 WHERE seminar_id = ?";
        $stmt = $con->prepare($public_query);
        $stmt->bind_param('i', $seminar_id);
        if ($stmt->execute()) {
            $_SESSION['positive'] = "Seminar is now public!";
        } else {
            $_SESSION['negative'] = "Failed to make seminar public!";
        }
        $stmt->close();
        header("Location: ./O_seminar_edit.php?id={$seminar_id}");
        exit();
    }


    header("Location: ./O_seminar.php");
    exit();
}
