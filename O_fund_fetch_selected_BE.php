<?php
    include('./db_con.php');
    $acc_id = $_SESSION['acc_id'];
    $fund_id = $_GET['fund_id'];
    $sql = "SELECT org_id FROM org_list WHERE acc_id = $acc_id";
    $sqlResult = mysqli_query($con, $sql);
    $sqlRow = mysqli_fetch_assoc($sqlResult);
    $org_id = $sqlRow['org_id'];

    $query1 = "SELECT f.fund_id, f.name, d.acc_id, d.donor_name, d.card_no, d.bkash_no, d.amount, d.date 
                FROM fund_donation_received AS d
                LEFT JOIN  funds f 
                ON d.fund_id = f.fund_id
                WHERE f.org_id = $org_id AND f.fund_id = $fund_id";
    $result1 = mysqli_query($con, $query1);
    if (mysqli_num_rows($result1) > 0) {
        while ($row1 = mysqli_fetch_assoc($result1)) {
            echo '<tr>' .
                '<td>' . $row1['date'] . '</td>' .
                '<td>' . $row1['name'] . '</td>' .
                '<td>' . $row1['donor_name'] . '</td>' .
                '<td>' . $row1['bkash_no'] . '</td>' .
                '<td>' . $row1['card_no'] . '</td>' .
                '<td>' . $row1['amount'] . '</td>' .
                '<td>
                    <a href="#?fund_id=' .$row1['fund_id']. '">Delete</a>
                </td>' .
                '</tr>';
        }
    } else {
        echo '<tr><td colspan="10"><p id="notFound">No fund received yet.</p></td></tr>';
    }

    $con->close();