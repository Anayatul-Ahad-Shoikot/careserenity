<?php
    // include('./db_con.php');
    // session_start();

    // if ($_SERVER['REQUEST_METHOD'] = 'POST') {
    //     $sender_name = $_POST['name'];
    //     $sender_email = $_POST['email'];
    //     $sender_contact = $_POST['mobile'];
    //     $msg_content = $_POST['msg'];

    //     $sql = "INSERT INTO contact_message (sender_name, sender_contact, sender_email, msg_content) VALUES ('$sender_name', '$sender_contact', '$sender_email', '$msg_content')";

    //     if (mysqli_query($con, $sql)) {
    //         $_SESSION['positive'] = 'Thank you for contacting us. Soon we will respond to your message.';
    //         header("Location: ./index.php");
    //         exit(0);
    //     } else {
    //         $_SESSION['negative'] = 'Failed to sent message. !';
    //         header("Location: ./index.php");
    //         exit(0);
    //     }

    // }
    // mysqli_close($con);
?>

<!-- sowrin change -->

<?php
    include('./db_con.php');
    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $sender_name = $_POST['name'];
        $sender_email = $_POST['email'];
        $sender_contact = $_POST['mobile'];
        $msg_content = $_POST['msg'];

        if (strlen($sender_contact) > 11) {
            $_SESSION['negative'] = 'Mobile number cannot be longer than 11 characters.';
            header("Location: ./index.php");
            exit(0);
        }

        $sql = "INSERT INTO contact_message (sender_name, sender_contact, sender_email, msg_content) VALUES ('$sender_name', '$sender_contact', '$sender_email', '$msg_content')";

        if (mysqli_query($con, $sql)) {
            $_SESSION['positive'] = 'Thank you for contacting us. Soon we will respond to your message.';
            header("Location: ./index.php");
            exit(0);
        } else {
            $_SESSION['negative'] = 'Failed to send message.';
            header("Location: ./index.php");
            exit(0);
        }

    }
    mysqli_close($con);
?>
