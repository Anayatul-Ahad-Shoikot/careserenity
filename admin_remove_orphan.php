<?php
    include('./db_con.php');

    if (isset($_GET['orphan_id'])) {
        $orphan_id = $_GET['orphan_id'];
        
        $query = "DELETE FROM orphan_list WHERE orphan_id = '$orphan_id'";
        $result = mysqli_query($con, $query);
        
        if ($result) {
            echo "<script>alert('Orphan removed successfully!'); window.location.href='admin_dashboard.php';</script>";
        } else {
            echo "<script>alert('Failed to remove orphan'); window.location.href='admin_dashboard.php';</script>";
        }
    }

    mysqli_close($con);
?>
