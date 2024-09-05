<?php
include('./db_con.php');
$acc_id_current = $_SESSION['acc_id'];


$query1 = "SELECT org_id FROM org_list WHERE acc_id = $acc_id_current";
$result1 = mysqli_query($con, $query1);
$row1 = mysqli_fetch_assoc($result1);
$org_id_current = $row1['org_id'];



$query2 = "SELECT COUNT(*) AS total_adoptions FROM adoptions AS ad
                    JOIN orphan_list AS orl ON ad.orphan_id = orl.orphan_id
                    WHERE orl.org_id = $org_id_current
                    AND ad.status = 'Pending'";
$result2 = mysqli_query($con, $query2);
$row2 = mysqli_fetch_assoc($result2);
$total_adoptions = $row2['total_adoptions'];



$query3 = "SELECT orl.first_name, orl.orphan_id, ul.user_name, ul.user_id ,ad.adoption_id, ad.status
                    FROM adoptions ad
                    JOIN orphan_list orl ON ad.orphan_id = orl.orphan_id
                    JOIN user_list ul ON ad.acc_id = ul.acc_id
                    WHERE orl.org_id = $org_id_current
                    ORDER BY ad.request_date";
$namesArray = [];
$result3 = mysqli_query($con, $query3);
if (mysqli_num_rows($result3) > 0) {
    $namesArray = array();
    while ($row3 = mysqli_fetch_assoc($result3)) {
        $namesArray[] = array(
            'status' => $row3['status'],
            'orphan_id' => $row3['orphan_id'],
            'user_id' => $row3['user_id'],
            'first_name' => $row3['first_name'],
            'user_name' => $row3['user_name'],
            'adoption_id' => $row3['adoption_id']
        );
    }
}
