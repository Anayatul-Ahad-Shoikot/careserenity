<?php
    include('./db_con.php');

    $query1 = "SELECT SUM(amount) AS total_amount FROM donations";
    $result1 = mysqli_query($con, $query1);
    $row1 = mysqli_fetch_assoc($result1);
    $total_donation_Serverd = $row1['total_amount'];

    $query2 = "SELECT COUNT(*) AS total_organizations FROM org_list";
    $result2 = mysqli_query($con, $query2);
    $row2 = mysqli_fetch_assoc($result2);
    $total_organizations = $row2['total_organizations'];

    $query3 = "SELECT COUNT(*) AS total_orphans FROM orphan_list";
    $result3 = mysqli_query($con, $query3);
    $row3 = mysqli_fetch_assoc($result3);
    $total_orphans = $row3['total_orphans'];

    $query4 = "SELECT COUNT(*) AS total_users FROM user_list";
    $result4 = mysqli_query($con, $query4);
    $row4 = mysqli_fetch_assoc($result4);
    $total_users = $row4['total_users'];
    
?>