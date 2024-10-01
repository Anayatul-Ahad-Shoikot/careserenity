<?php
    include("./db_con.php");
    $acc_id = $_SESSION['acc_id'];
    $fetchUnreadNotificationsQuery = "SELECT COUNT(*) as unread_count FROM notifications WHERE is_read = 0 AND org_id = (SELECT org_id FROM org_list WHERE acc_id = $acc_id)";
    $unreadNotificationsResult = mysqli_query($con, $fetchUnreadNotificationsQuery);
    $unreadCount = 0;
    if ($unreadNotificationsResult) {
        $unreadRow = mysqli_fetch_assoc($unreadNotificationsResult);
        $unreadCount = $unreadRow['unread_count'];
    }
    $seminar_id = $_GET['id'];
    $query = "SELECT * FROM seminars WHERE seminar_id = $seminar_id";
    $result = mysqli_query($con, $query);
    $seminar = mysqli_fetch_assoc($result);
    $title = $seminar['title'];
    $description = $seminar['description'];
    $banner = $seminar['banner'];
    $seminar_date = $seminar['seminar_date'];
    $type = $seminar['type'];
    $subject = $seminar['subject'];
    $guest = $seminar['guest'];
    $location = $seminar['location'];
    $visibility = $seminar['visibility'];


    $query2 = "SELECT COUNT(*) as count FROM seminar_participants WHERE seminar_id = $seminar_id";
    $result2 = mysqli_query($con, $query2);
    $row2 = mysqli_fetch_assoc($result2);
    $total_participents = $row2['count'];