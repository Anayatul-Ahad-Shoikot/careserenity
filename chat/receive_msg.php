<?php
    session_start();
    include('../db_con.php');
    
    $user_id = $_SESSION['acc_id'];
    $role = $_SESSION['role'];
    
    if ($role == 'user') {
        $query = $db->prepare("SELECT * FROM chats WHERE outgoing_msg_id = ? OR incoming_msg_id = ?");
        $query->execute([$user_id, $user_id]);
    } elseif ($role == 'org') {
        $query = $db->prepare("SELECT * FROM chats WHERE outgoing_msg_id = ? OR incoming_msg_id = ?");
        $query->execute([$user_id, $user_id]);
    } elseif ($role == 'admin') {
        $query = $db->prepare("SELECT * FROM chats WHERE incoming_msg_id = 2"); // Admin ID
        $query->execute();
    }
    
    while ($row = $query->fetch()) {
        echo "<div><b>User " . $row['outgoing_msg_id'] . ":</b> " . $row['msg'] . "</div>";
    }
?>    