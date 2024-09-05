<?php
    include('./db_con.php');

    if ($_SERVER['REQUEST_METHOD'] = 'POST') {
        $sender_name = $_POST['name'];
        $sender_email = $_POST['email'];
        $sender_contact = $_POST['mobile'];
        $msg_content = $_POST['msg'];

        $sql = "INSERT INTO contact_message (sender_name, sender_contact, sender_email, msg_content) VALUES ('$sender_name', '$sender_contact', '$sender_email', '$msg_content')";

        if (mysqli_query($con, $sql)) {
            header("Location: ./index.php");
            exit(0);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
            header("Location: ./index.php");
            exit(0);
        }

    }
    mysqli_close($con);
?>