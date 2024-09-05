<?php

include('db_con.php');

if (isset($_GET['orphan_id'])) {
    $orphan_id = mysqli_real_escape_string($con, $_GET['orphan_id']);
    $fetchOrphanQuery = "SELECT * FROM orphan_list WHERE orphan_id = $orphan_id";
    $result = mysqli_query($con, $fetchOrphanQuery);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        $orphan_id = $row['orphan_id'];
        $org_id = $row['org_id'];
        $first_name = $row['first_name'];
        $age = $row['age'];
        $gender = $row['gender'];
        $religion = $row['religion'];
        $guardian_id = $row['guardian_id'];
        $date_of_birth = $row['date_of_birth'];
        $since = $row['since'];
        $family_status = $row['family_status'];
        $physical_condition = $row['physical_condition'];
        $education_level = $row['education_level'];
        $medical_history = $row['medical_history'];
        $hobby = $row['hobby'];
        $favorite_food = $row['favorite_food'];
        $favorite_game = $row['favorite_game'];
        $skills = $row['skills'];
        $dreams = $row['dreams'];
        $problems = $row['problems'];
        $other_comments = $row['other_comments'];
        $orphan_image = $row['orphan_image'];
        $adoption_status = $row['adoption_status'];

        $query2 = "SELECT org_name, org_location, org_phone FROM org_list WHERE org_id = $org_id";
        $result2 = mysqli_query($con, $query2);
        if (mysqli_num_rows($result2) == 1) {
            $row2 = mysqli_fetch_assoc($result2);
            $org_name = $row2['org_name'];
            $org_location = $row2['org_location'];
            $org_phone = $row2['org_phone'];
        }

        $query3 = "SELECT * FROM local_orphan_guardian WHERE guardian_id = $guardian_id";
        $result3 = mysqli_query($con, $query3);
        if (mysqli_num_rows($result3) == 1) {
            $row3 = mysqli_fetch_assoc($result3);
            $guardian_name = $row3['guardian_name'];
            $guardian_contact = $row3['guardian_contact'];
            $guardian_location = $row3['guardian_location'];
        }
    } else {
        echo 'Orphan profile not found.';
    }
} else {
    echo "error";
}
?>