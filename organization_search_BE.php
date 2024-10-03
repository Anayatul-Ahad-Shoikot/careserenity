<?php
    include('./db_con.php');

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['query'])) {
        $role = $_SESSION['role'];
        $search = $_GET['query'];
        if (!empty($search)) {
            $query = "SELECT * FROM org_list WHERE org_name LIKE '%$search%' OR org_location LIKE '%$search%'";
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="org-card">';
                    echo '<div class="x">';

                        echo '<div class="org_img"><img src="./assets/' . $row['org_logo'] . '" alt=""></div>';
                        
                        echo '<div class="org_info">';
                            echo '<h1 class="org_title">' . $row['org_name'] . '</h1>';
                            echo '<p class="org_vision">' . $row['org_vision'] . '</p>';
                            echo '<p>Phone : ' . $row['org_phone'] . '</p>';
                            echo '<p>Email : ' . $row['org_email'] . '</p>';
                        echo '</div>';
                    echo '</div>';

                    echo '<div class="action_button">';
                        if ($role == 'org') {
                            echo '<a href="./O_see_organization_profile.php?org_id=' . $row['org_id'] . '" id="button-30"> Visit </a>';
                        } else if ($role == 'admin') {
                            echo '<a href="#/O_VIEW_ORG.php?org_id=' . $row['org_id'] . '"> Visit </a>';
                        } else {
                            echo '<a href="./U_see_organization_profile.php?org_id=' . $row['org_id'] . '" id="button-30"> View </a>';
                            echo '<a href="./U_donation.php?org_id=' . $row['org_id'] . '" id="button-30"> Donate </a>';
                        }
                    echo '</div>';
                echo '</div>';
                }
            } else {
                echo '<p id="notFound">Searched Organization not found.</p>';
            }
        } else {
            echo '<p id="notFound">There is no empty Organization</p>';
        }
    } else {
        header("Location: ./O_organization.php");
        exit();
    }
    mysqli_close($con);

?>