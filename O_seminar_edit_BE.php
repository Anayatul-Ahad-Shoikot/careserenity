<?php
    include("./db_con.php");
    session_start();
    $acc_id = $_SESSION['acc_id'];
    $fetchUnreadNotificationsQuery = "SELECT COUNT(*) as unread_count FROM notifications WHERE is_read = 0 AND org_id = (SELECT org_id FROM org_list WHERE acc_id = $acc_id)";
    $unreadNotificationsResult = mysqli_query($con, $fetchUnreadNotificationsQuery);
    $unreadCount = 0;
    if ($unreadNotificationsResult) {
        $unreadRow = mysqli_fetch_assoc($unreadNotificationsResult);
        $unreadCount = $unreadRow['unread_count'];
    }
    if(isset($_GET['id'])){
        $seminar_id = $_GET['id'];
        $query = "SELECT * FROM seminars WHERE seminar_id = $seminar_id";
        $result = mysqli_query($con, $query);
        $seminar = mysqli_fetch_assoc($result);
            $title = $seminar['title'];
            $description = $seminar['description'];
            $banner = $seminar['banner'];
            $date = $seminar['seminar_date'];
            $type = $seminar['type'];
            $topic = $seminar['topic'];
            $guest = $seminar['guest'];
    }
    else{
        echo "Invalid seminar ID.";
    }
?>