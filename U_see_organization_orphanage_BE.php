<?php
    include('./db_con.php');
    $org_id = $_GET['org_id'];
    $role = $_SESSION['role'];
    $query = "SELECT orphan_image, first_name, last_name, orphan_id FROM orphan_list Where (org_id = $org_id AND adoption_status = 0)";
    $result = mysqli_query($con, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="plate">';
            echo '<div class="card">';
            echo '<div class="pb"  style="background-image: url(\'./assets/' . $row['orphan_image'] . '\');"></div>';
            echo '<div class="info">';
            echo '<h1>' . $row['first_name'] . ' ' . $row['last_name'] . '</h1>';
            echo '</div>';
            echo '<div class="buttons">';
            echo '<a href="./U_donation.php?orphan_id=' . $row['orphan_id'] . '&org_id=' . $org_id . '" id="button-30">Gift</a>';
            echo '<a href="./U_see_orphan_profile.php?orphan_id=' . $row['orphan_id'] . '" id="button-30"> View </a>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<p id="notFound">No orphans to show.</p>';
    }

    mysqli_close($con);
?>