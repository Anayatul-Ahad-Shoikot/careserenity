<?php
    include('./db_con.php');

    if (isset($_GET['org_id'])) {
        $org_id = $_GET['org_id'];
        
        $query = "DELETE FROM org_list WHERE org_id = '$org_id'";
        $result = mysqli_query($con, $query);
        
        if ($result) {
            echo "<script>alert('Organization removed successfully!'); window.location.href='admin_dashboard.php';</script>";
        } else {
            echo "<script>alert('Failed to remove organization'); window.location.href='admin_dashboard.php';</script>";
        }
    }

    mysqli_close($con);
?>
