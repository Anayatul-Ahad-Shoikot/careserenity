<?php
    include('./db_con.php');

    if (isset($_GET['org_id'])) {
        $org_id = $_GET['org_id'];

        mysqli_begin_transaction($con);

        try {
            $get_acc_id_query = "SELECT acc_id FROM org_list WHERE org_id = '$org_id'";
            $acc_id_result = mysqli_query($con, $get_acc_id_query);
            $acc_id_row = mysqli_fetch_assoc($acc_id_result);
            $acc_id = $acc_id_row['acc_id'];

            $query_org = "DELETE FROM org_list WHERE org_id = '$org_id'";
            mysqli_query($con, $query_org);

            $query_acc = "DELETE FROM accounts WHERE acc_id = '$acc_id'";
            mysqli_query($con, $query_acc);

            mysqli_commit($con);

            echo "<script>alert('Organization and related records removed successfully!'); window.location.href='admin_dashboard.php';</script>";

        } catch (Exception $e) {
            mysqli_rollback($con);
            echo "<script>alert('Failed to remove organization.'); window.location.href='admin_dashboard.php';</script>";
        }
    }

    mysqli_close($con);
?>