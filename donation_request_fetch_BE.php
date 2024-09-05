<?php
include('./db_con.php');

$acc_id_current = $_SESSION['acc_id'];
$query1 = "SELECT org_id FROM org_list WHERE acc_id = $acc_id_current";
$result1 = mysqli_query($con, $query1);
$row1 = mysqli_fetch_assoc($result1);
$org_id_current = $row1['org_id'];



$query2 = "SELECT COUNT(*) AS total_donations FROM donations AS d
                    WHERE (d.receiver_type = 'orphan'
                    AND EXISTS (SELECT 1 FROM orphan_list AS o WHERE o.orphan_id = d.receiver_id AND o.org_id = $org_id_current))
                    OR (d.receiver_type = 'organization' AND d.receiver_id = $org_id_current)";
$result2 = mysqli_query($con, $query2);
$row2 = mysqli_fetch_assoc($result2);
$total_donations = $row2['total_donations'];




$query3 = "SELECT SUM(amount) AS total_amount_received FROM donations
                WHERE (receiver_id = $org_id_current AND receiver_type = 'organization')
                OR (receiver_type = 'orphan' AND receiver_id 
                IN (SELECT orphan_id FROM orphan_list WHERE org_id = $org_id_current))";
$result3 = mysqli_query($con, $query3);
$row3 = mysqli_fetch_assoc($result3);
$total_amount_received = $row3['total_amount_received'];



$query4 = "SELECT ul.user_id, ul.user_name, orl.first_name, d.amount, d.receiver_type FROM donations AS d
                LEFT JOIN user_list AS ul ON d.donor_id = ul.user_id
                LEFT JOIN orphan_list AS orl ON d.receiver_id = orl.orphan_id
                WHERE (d.receiver_type = 'orphan' AND orl.org_id = $org_id_current)
                OR (d.receiver_type = 'organization' AND d.receiver_id = $org_id_current)";
$result4 = mysqli_query($con, $query4);
$resultArray = [];
if (mysqli_num_rows($result4) > 0) {
    $resultArray = array();
    while ($row4 = mysqli_fetch_assoc($result4)) {
        $resultArray[] = array(
            'user_name' => $row4['user_name'],
            'user_id' => $row4['user_id'],
            'first_name' => $row4['first_name'],
            'amount' => $row4['amount'],
            'receiver_type' => $row4['receiver_type']
        );
    }
}


$query5 = "SELECT SUM(d.amount) AS total_amount_received_by_orphans
                FROM donations AS d
                JOIN orphan_list AS o ON d.receiver_id = o.orphan_id
                WHERE o.org_id = $org_id_current
                AND d.receiver_type = 'orphan'";
$result5 = mysqli_query($con, $query5);
$row5 = mysqli_fetch_assoc($result5);
$total_amount_received_by_orphans = $row5['total_amount_received_by_orphans'];