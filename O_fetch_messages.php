<?php
include("../../../BackEnd/db_con.php");
session_start();
$acc_id = $_SESSION['acc_id'];
$chat_with = isset($_POST['chat_with']) ? $_POST['chat_with'] : '';

if (!$chat_with) {
    echo json_encode([]);
    exit;
}

$query = "SELECT * FROM chats WHERE (outgoing_msg_id = ? AND incoming_msg_id = ?) OR (outgoing_msg_id = ? AND incoming_msg_id = ?) ORDER BY timestamp";
$stmt = $con->prepare($query);
$stmt->bind_param("iiii", $acc_id, $chat_with, $chat_with, $acc_id);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode($messages);
?>
