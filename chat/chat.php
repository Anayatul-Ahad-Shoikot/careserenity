<?php 
    // include("./db_con.php");
    // session_start();
    // $acc_id = $_SESSION['acc_id'];
    // $fetchUnreadNotificationsQuery = "SELECT COUNT(*) as unread_count FROM notifications WHERE is_read = 0 AND org_id = (SELECT org_id FROM org_list WHERE acc_id = $acc_id)";
    // $unreadNotificationsResult = mysqli_query($con, $fetchUnreadNotificationsQuery);
    // $unreadCount = 0;
    // if ($unreadNotificationsResult) {
    // $unreadRow = mysqli_fetch_assoc($unreadNotificationsResult);
    // $unreadCount = $unreadRow['unread_count'];
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./assets/LOGO.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet" href="./css/colors.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/feedback.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/footer.css">
    <title>CareSenerity | Chat</title>
</head>
<body onload="loadMessages()">

    <h2>Chat with Organization/Admin</h2>
    <div id="chat-box" style="border:1px solid #ccc; padding:10px; height:300px; overflow:auto;"></div>
    <input type="text" id="message" placeholder="Type your message...">
    <button onclick="sendMessage()">Send</button>

    <script src="../js/chat_mine.js"></script>
    
</body>
</html>