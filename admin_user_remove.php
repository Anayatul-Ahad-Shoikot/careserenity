w<?php
    include('./db_con.php');

    if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];

        $get_acc_id_query = "SELECT acc_id FROM user_list WHERE user_id = $user_id";
        $acc_id_result = mysqli_query($con, $get_acc_id_query);
        $acc_id_row = mysqli_fetch_assoc($acc_id_result);
        $acc_id = $acc_id_row['acc_id'];
        
        $query_org = "DELETE FROM user_list WHERE user_id = $user_id";
        mysqli_query($con, $query_org);

        $query_acc = "DELETE FROM accounts WHERE acc_id = $acc_id";
        mysqli_query($con, $query_acc);
    }

    header("Location: ./admin_user.php");
    exit();
