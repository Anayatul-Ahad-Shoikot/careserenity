<?php
    include './db_con.php';
    $seminar_id = $_GET['id'];
    $query = "SELECT u.user_name, u.user_contact, u.user_id, u.user_gender, u.user_address FROM volunteer_recruite AS r LEFT JOIN vol_participants AS v ON v.recruite_id = r.recruite_id LEFT JOIN user_list AS u ON u.user_id = v.user_id  WHERE r.seminar_id = $seminar_id";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_assoc($result)){
            echo '<tr>' .
            '<td>' . $row['user_name'] . '</td>' .
            '<td>' . $row['user_contact'] . '</td>' .
            '<td>' . $row['user_gender'] . '</td>' .
            '<td>' . $row['user_address'] . '</td>' .
            '</tr>';
        }
    } else {
        echo '<tr><td colspan="5"><p id="notFound">No volunteer register yet.</p></td></tr>';
    }
    
