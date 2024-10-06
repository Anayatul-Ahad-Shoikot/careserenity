w<?php
    include('./db_con.php');

    if (isset($_GET['acc_id'])) {
        $acc_id = $_GET['acc_id'];
        
        $query = "DELETE FROM user_list WHERE acc_id = '$acc_id'";
        $result = mysqli_query($con, $query);
        
        if ($result) {
            echo "<script>alert('User removed successfully!'); window.location.href='admin_dashboard.php';</script>";
        } else {
            echo "<script>alert('Failed to remove user'); window.location.href='admin_dashboard.php';</script>";
        }
    }

    mysqli_close($con);
?>
