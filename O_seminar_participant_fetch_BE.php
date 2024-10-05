<?php
    include('./db_con.php');
    $acc_id = $_SESSION['acc_id'];

    $query = "SELECT org_id FROM org_list WHERE acc_id = $acc_id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $org_id = $row['org_id'];

    $query2 = "SELECT S.seminar_id, U.user_name, U.user_contact, SP.reg_date, AC.acc_email 
                FROM seminars AS S
                INNER JOIN seminar_participants AS SP ON SP.seminar_id = S.seminar_id
                INNER JOIN user_list AS U ON U.user_id = SP.participant_id
                INNER JOIN accounts AS AC ON AC.acc_id = U.acc_id
                WHERE S.org_id = $org_id AND S.seminar_id = $seminar_id";

$result2 = mysqli_query($con, $query2);
if (mysqli_num_rows($result2) > 0) {
    while ($row2 = mysqli_fetch_assoc($result2)) {
        echo '<tr>' .
            '<td>' . $row2['user_name'] . '</td>' .
            '<td>' . $row2['acc_email'] . '</td>' .
            '<td>' . $row2['user_contact'] . '</td>' .
            '<td>' . $row2['reg_date'] . '</td>' .
            '</tr>';
    }
} else {
    echo '<tr><td colspan="5"><p id="notFound">No registration yet</p></td></tr>';
}