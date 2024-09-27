<?php
    include './db_con.php';
    $sql = "SELECT funds.*, org_list.org_name FROM funds LEFT JOIN org_list ON funds.org_id = org_list.org_id WHERE funds.completed = ?";
    $value = 0;
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $value);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($fund = $result->fetch_assoc()) {
        echo '<div class="card">';
        echo '<img src="./assets/' . htmlspecialchars($fund['img']) . '" alt="">';
        echo '<h1>' . htmlspecialchars($fund['name']) . '</h1>';
        echo '<p>' . htmlspecialchars($fund['org_name']) . '</p>';
        echo '<p class="price">' . htmlspecialchars($fund['received']) . '/' . htmlspecialchars($fund['amount']) . '</p>';
        echo '<a href="./fund_donate_loggedout.php?fund_id=' . $fund['fund_id'] . '&org_id='.$fund['org_id'].'" id="button-30">Donate</a>';
        echo '</div>';
    }
    $stmt->close();
    $con->close();
