<?php
    include('./db_con.php');

    if (isset($_GET['org_id'])) {
        $org_id = $_GET['org_id'];

        $get_acc_id_query = "SELECT acc_id FROM org_list WHERE org_id = $org_id";
        $acc_id_result = mysqli_query($con, $get_acc_id_query);
        $acc_id_row = mysqli_fetch_assoc($acc_id_result);
        $acc_id = $acc_id_row['acc_id'];

        $query_org = "DELETE FROM org_list WHERE org_id = $org_id";
        mysqli_query($con, $query_org);

        $query_acc = "DELETE FROM accounts WHERE acc_id = $acc_id";
        mysqli_query($con, $query_acc);

        mysqli_commit($con);

    }
    header("Location: ./admin_organization.php");
    exit();