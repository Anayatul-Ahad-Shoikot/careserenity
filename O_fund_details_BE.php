<?php
include './db_con.php';
    $fund_id = $_GET['fund_id'];
    $acc_id = $_SESSION['acc_id'];
    $query = "SELECT org_id FROM org_list WHERE acc_id = $acc_id";
    $result = $con->query($query);
    $row = $result->fetch_assoc();
    $org_id = $row['org_id'];

    $sql = "SELECT funds.fund_id, funds.name, funds.received, funds.amount, funds.img, funds.duration FROM funds WHERE funds.fund_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $fund_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $fund = $result->fetch_assoc();