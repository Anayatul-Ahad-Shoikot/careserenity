<?php
    include('./db_con.php');

    $acc_id = $_SESSION['acc_id'];
    $sql = "SELECT org_id FROM org_list WHERE acc_id = $acc_id";
    $sqlResult = mysqli_query($con, $query1);
    $sqlRow = mysqli_fetch_assoc($sqlResult);
    $org_id = $sqlRow['org_id'];

    $query1 = "SELECT 
                    d.donation_id, 
                    d.donor_id, 
                    d.receiver_id, 
                    d.receiver_orphan_id, 
                    d.payment_method, 
                    d.amount, 
                    d.receiving_date, 
                    user.user_name, 
                    user.user_id,
                    CASE 
                        WHEN d.receiver_orphan_id IS NOT NULL THEN o.first_name 
                        ELSE '' 
                    END AS first_name,
                    CASE 
                        WHEN d.receiver_orphan_id IS NOT NULL THEN o.last_name 
                        ELSE '' 
                    END AS last_name
                FROM donations AS d 
                LEFT JOIN orphan_list AS o ON o.orphan_id = d.receiver_orphan_id
                LEFT JOIN user_list AS user ON user.acc_id = d.donor_id
                LEFT JOIN org_list AS org ON org.org_id = d.receiver_id
                WHERE org.org_id = $org_id";
    $result1 = mysqli_query($con, $query1);
    if (mysqli_num_rows($result1) > 0) {
        while ($row1 = mysqli_fetch_assoc($result1)) {
            echo '<tr>' .
                '<td>' . $row1['receiving_date'] . '</td>' .
                '<td>' . $row1['user_name'] . '</td>' .
                '<td>' . $row1['first_name'] . ' ' . $row1['last_name'] . '</td>' .
                '<td>' . $row1['payment_method'] . '</td>' .
                '<td>' . $row1['amount'] . '</td>' .
                '<td>
                    <a href="O_adoption_data_delete_BE.php?adoption_id=' .$row1['donation_id']. '">Delete</a>
                </td>' .
                '</tr>';
        }
    } else {
        echo '<tr><td colspan="10"><p id="notFound">No adoption request yet.</p></td></tr>';
    }

    $con->close();