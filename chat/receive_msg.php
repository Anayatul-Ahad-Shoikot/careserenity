<?php
    session_start();
    include('../db_con.php');
    
    $user_id = $_SESSION['acc_id'];
    $role = $_SESSION['role'];
    
    if ($role == 'user') {
        $query = $db->prepare("SELECT * FROM messages WHERE sender_id = ? OR receiver_id = ?");
        $query->execute([$user_id, $user_id]);
    } elseif ($role == 'org') {
        $query = $db->prepare("SELECT * FROM messages WHERE sender_id = ? OR receiver_id = ?");
        $query->execute([$user_id, $user_id]);
    } elseif ($role == 'admin') {
        $query = $db->prepare("SELECT * FROM messages WHERE receiver_id = 2"); // Admin ID
        $query->execute();
    }
    
    while ($row = $query->fetch()) {
        echo "<div><b>User " . $row['sender_id'] . ":</b> " . $row['message'] . "</div>";
    }
?>    