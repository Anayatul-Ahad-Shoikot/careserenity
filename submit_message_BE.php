<?php
    session_start();
    include('db_con.php');

    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $message = $_POST['message'];

    $is_registered = isset($_SESSION['acc_id']) ? 1 : 0;
    $sender_id = NULL;
    $role = NULL;

    if ($is_registered) {
        $acc_id = $_SESSION['acc_id'];
        $role_sql = "SELECT role FROM accounts WHERE acc_id = ?";
        $role_stmt = $con->prepare($role_sql);
        $role_stmt->bind_param("i", $acc_id);
        $role_stmt->execute();
        $role_stmt->bind_result($role);
        $role_stmt->fetch();
        $role_stmt->close();

        if ($role == 'org') {
            $org_sql = "SELECT org_id FROM org_list WHERE acc_id = ?";
            $org_stmt = $con->prepare($org_sql);
            $org_stmt->bind_param("i", $acc_id);
            $org_stmt->execute();
            $org_stmt->bind_result($sender_id);
            $org_stmt->fetch();
            $org_stmt->close();
        } elseif ($role == 'user') {
            $user_sql = "SELECT user_id FROM user_list WHERE acc_id = ?";
            $user_stmt = $con->prepare($user_sql);
            $user_stmt->bind_param("i", $acc_id);
            $user_stmt->execute();
            $user_stmt->bind_result($sender_id);
            $user_stmt->fetch();
            $user_stmt->close();
        }
    }

    $sql = "INSERT INTO contact_message (sender_name, sender_contact, sender_id, msg_content, is_registerd) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssisi", $name, $mobile, $sender_id, $message, $is_registered);

    if ($stmt->execute()) {
        if ($is_registered) {
            $feedback_msg = "Thank you for your message. We will get back to you shortly.";
            $outgoing_msg_id = "website";
            $incoming_msg_id = $sender_id;
            $chat_sql = "INSERT INTO chats (outgoing_msg_id, incoming_msg_id, msg) VALUES (?, ?, ?)";
            $chat_stmt = $con->prepare($chat_sql);
            $chat_stmt->bind_param("sss", $outgoing_msg_id, $incoming_msg_id, $feedback_msg);

            if ($chat_stmt->execute()) {
                $_SESSION['positive'] = "Message sent successfully!";
            } else {
                $_SESSION['negative'] = "Message sent, but failed to send feedback: ";
            }
            $chat_stmt->close();
        } else {
            $_SESSION['positive'] = "Message sent successfully!";
        }
    } else {
        $_SESSION['negative'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    $con->close();

    header("Location: /FrontEnd/loggedIn/organizationpage/aboutus.php");
    exit(0);
?>
