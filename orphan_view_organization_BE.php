<?php
    include('db_con.php');

    $acc_id = $_SESSION['acc_id'];
    $query1 = "SELECT org_id FROM org_list WHERE acc_id = $acc_id";
    $result1 = mysqli_query($con, $query1);
    $row1 = mysqli_fetch_assoc($result1);
    $org_id = $row1['org_id'];

    $query2 = "SELECT orphan_id, first_name, orphan_image, adoption_status FROM orphan_list WHERE org_id = $org_id AND removed_status != '1'";
    $result2 = mysqli_query($con, $query2);
    if (mysqli_num_rows($result2) > 0) {
        while ($row2 = mysqli_fetch_assoc($result2)) {
            echo '<div class="card">';
            echo '<div class="pb"  style="background-image: url(\'/UserImage/childpic/' . $row2['orphan_image'] . '\');"></div>';
            echo '<div class="info">';
            echo '<h1>' . $row2['first_name'] . '</h1>';
            echo '</div>';
            echo '<div class="buttons">';
            echo '<a href="/BackEnd/orphan_remove_organization_BE.php?orphan_id=' . $row2['orphan_id'] . '" id="button-30">Remove</a>';
            echo '<a href="/FrontEnd/loggedIn/organizationpage/orphan_profile.php?orphan_id=' . $row2['orphan_id'] . '" id="button-30"> View </a>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo 'No orphan found to show.';
    }

    mysqli_close($con);
?>