<?php
    session_start();
    include('../db_con.php');
    
    if (isset($_POST['msg'])) {
        $sender_id = $_SESSION['acc_id'];
        $message = $_POST['msg'];
        $role = $_SESSION['role'];
    
        if ($role == 'user') {
            $receiver_id = 1; // Assuming org ID 1
        } elseif ($role == 'org') {
            $receiver_id = 2; // Assuming admin ID 2
        }
    
        $query = $db->prepare("INSERT INTO chats (outgoing_msg_id, incoming_msg_id, msg) VALUES (?, ?, ?)");
        $query->execute([$sender_id, $receiver_id, $message]);
    
        echo "Message sent";
    }
    
?>