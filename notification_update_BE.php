<?php
    include('./db_con.php');
    $notificationId = $_GET['id'];
    $updateQuery = "UPDATE notifications SET is_read = 1 WHERE notification_id = $notificationId";
    $result = mysqli_query($con, $updateQuery);
    if ($result) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => mysqli_error($con)]);
    }
    mysqli_close($con);
?>