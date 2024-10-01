<?php
    session_start();
    include('../db_con.php');
    
    if (isset($_POST['message'])) {
        $sender_id = $_SESSION['acc_id'];
        $message = $_POST['message'];
        $role = $_SESSION['role'];
    
        if ($role == 'user') {
            $receiver_id = 1; // Assuming organization ID 1
        } elseif ($role == 'org') {
            $receiver_id = 2; // Assuming admin ID 2
        }
    
        $query = $db->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        $query->execute([$sender_id, $receiver_id, $message]);
    
        echo "Message sent";
    }
    
?>