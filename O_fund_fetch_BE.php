<?php
    include './db_con.php';
    $acc_id = $_SESSION['acc_id'];
    $query = "SELECT org_id FROM org_list WHERE acc_id = $acc_id";
    $result = $con->query($query);
    $row = $result->fetch_assoc();
    $org_id = $row['org_id'];

    $sql = "SELECT funds.fund_id, funds.name, funds.received, funds.amount, org_list.org_name, funds.img
            FROM funds
            LEFT JOIN org_list ON funds.org_id = org_list.org_id
            WHERE funds.org_id = ?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $org_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($fund = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<img src="./assets/' . htmlspecialchars($fund['img']) . '" alt="">';
        echo '<h1>' . htmlspecialchars($fund['name']) . '</h1>';
        echo '<p>' . htmlspecialchars($fund['org_name']) . '</p>';
        echo '<p class="price">' . htmlspecialchars($fund['received']) . '/' . htmlspecialchars($fund['amount']) . '</p>';
        echo '<a href="./O_fund_details.php?fund_id=' . htmlspecialchars($fund['fund_id']) . '" id="button-30">Details</a>';
        echo '</div>';
    }
    $stmt->close();
    $con->close();
