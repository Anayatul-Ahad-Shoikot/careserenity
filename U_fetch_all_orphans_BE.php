<?php
    include('./db_con.php');
    $query = "SELECT orphan_image, first_name, last_name, orphan_id, org_id FROM orphan_list Where adoption_status = 0";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="card">';
            echo '<div class="pb"  style="background-image: url(\'./assets/' . $row['orphan_image'] . '\');"></div>';
            echo '<div class="info">';
            echo '<h1>' . $row['first_name'] . ' ' . $row['last_name'] . '</h1>';
            echo '</div>';
            echo '<div class="buttons">';
            echo '<a href="./U_donation.php?orphan_id=' . $row['orphan_id'] . '&org_id=' . $row['org_id'] . '" id="button-30">Gift</a>';
            echo '<a href="./U_see_orphan_profile.php?orphan_id=' . $row['orphan_id'] . '" id="button-30"> View </a>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo 'No orphans to show.';
    }

    mysqli_close($con);
?>