<?php
    include('./db_con.php');

    $acc_id = $_SESSION['acc_id'];

    $query1 = "SELECT a.adoption_id, a.orphan_id, a.acc_id, a.request_date, a.status, a.issued_date, a.email, 
                        o.first_name, o.last_name, o.org_id, a.org_delete, u.user_name, u.user_id
                    FROM adoptions AS a 
                    LEFT JOIN orphan_list AS o ON o.orphan_id = a.orphan_id 
                    LEFT JOIN org_list AS ol ON ol.org_id = o.org_id
                    LEFT JOIN user_list AS u ON u.acc_id = a.acc_id
                    WHERE ol.acc_id = $acc_id AND a.org_delete = 0";
                    
    $result1 = mysqli_query($con, $query1);

    if (mysqli_num_rows($result1) > 0) {
        while ($row1 = mysqli_fetch_assoc($result1)) {
            if($row1['status'] == 0) {
                $status = "Pending";
            } else if($row1['status'] == 1) {
                $status = "Approved";
            } else {
                $status = "Rejected";
            }
            echo '<tr>' .
                '<td id="name_' . $row1['user_id'] . '">' . $row1['user_name'] . '</td>' .
                '<td>' . $row1['email'] . '</td>' .
                '<td id="type_' . $row1['orphan_id'] . '">' . $row1['first_name'] . ' ' . $row1['last_name'] . '</td>' .
                '<td>' . $row1['request_date'] . '</td>' .
                '<td>' . $row1['issued_date'] . '</td>' .
                '<td><p class="' . ($row1['status'] != 0 ? "status delivered" : "status cancelled") . '">' . $status . '</p></td>' .
                '<td>
                    <a href="O_adoption_data_delete_BE.php?adoption_id=' .$row1['adoption_id']. '">Delete</a>
                </td>' .
                '</tr>';
        }
    } else {
        echo '<tr><td colspan="10"><p id="notFound">No adoption request yet.</p></td></tr>';
    }

    $con->close();