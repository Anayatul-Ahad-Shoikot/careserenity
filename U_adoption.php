<?php
    include("./db_con.php");
    session_start();
    $acc_id = $_SESSION['acc_id'];
    $fetchUnreadNotificationsQuery = "SELECT COUNT(*) as unread_count FROM notifications WHERE is_read = 0 AND user_id = (SELECT user_id FROM user_list WHERE acc_id = $acc_id)";
    $unreadNotificationsResult = mysqli_query($con, $fetchUnreadNotificationsQuery);
    $unreadCount = 0;
    if ($unreadNotificationsResult) {
        $unreadRow = mysqli_fetch_assoc($unreadNotificationsResult);
        $unreadCount = $unreadRow['unread_count'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet" href="./css/colors.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/orphan.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/feedback.css">
    <link rel="icon" href="./assets/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Adoption</title>
</head>

<body>

    <?php include "./navbarU.php" ?>

    <div class="feedback">
        <?php
        if (isset($_SESSION['positive'])) {
            echo '<div class="positive">
                        <h5>' . $_SESSION['positive'] . '</h5>
                    </div>';
            unset($_SESSION['positive']);
        }
        if (isset($_SESSION['negative'])) {
            echo '<div class="negative">
                        <h5>' . $_SESSION['negative'] . '</h5>
                    </div>';
            unset($_SESSION['negative']);
        }
        ?>
    </div>

    <div class="container">
        <div class="options">
                <a href="./U_adoption.php" id="button-30"><i class='bx bx-refresh' style="color:black"></i></a>
                <form method="GET">
                <div style="padding-right: 8px; border-right: 1px solid black; color:white">
                    <label><input type="checkbox" name="gender" value="male"> Boy </label>
                    <label><input type="checkbox" name="gender" value="female"> Girl </label>
                </div>
                &nbsp;
                &nbsp;
                <input type="text" name="query" placeholder="Search Child...">
                <button type="submit"><i class='bx bx-search-alt'></i></button>
            </form>
        </div>
        <!-- <div class="plate"> -->
            <?php
                include('./db_con.php');
                if(isset($_GET['query']) || isset($_GET['gender']) || isset($_GET['adoption_status'])){
                    $query = isset($_GET['query']) ? $_GET['query'] : '';
                    $gender = isset($_GET['gender']) ? $_GET['gender'] : '';
                    $adoption_status = isset($_GET['adoption_status']) ? $_GET['adoption_status'] : '';
                    $sql = "SELECT * FROM orphan_list WHERE removed_status = 0 AND adoption_status = 0";
                    $conditions = [];
                    $params = [];
                    if (!empty($query)) {
                        $conditions[] = "(first_name LIKE ? OR last_name LIKE ? OR religion LIKE ? OR age LIKE ?)";
                        $search_query = "%" . $query . "%";
                        array_push($params, $search_query, $search_query, $search_query, $search_query);
                    }
                    if (!empty($gender)) {
                        $conditions[] = "gender = ?";
                        array_push($params, $gender);
                    }
                    if (!empty($conditions)) {
                        $sql .= " AND " . implode(" AND ", $conditions);
                    }
                    $stmt = $con->prepare($sql);
        
                    if (!empty($params)) {
                        $types = str_repeat('s', count($params));
                        $stmt->bind_param($types, ...$params);
                    }
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if ($result->num_rows > 0) {
                        echo '<div class="plate">';
                        while ($row = $result->fetch_assoc()) {
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
                        echo '</div>';
                    } else {
                        echo '<p id="notFound">No matched result found!</p>';
                    }
                } else {
                    include ('./U_fetch_all_orphans_BE.php');
                }
            ?>
        <!-- </div> -->
    </div>

    <?php include "./footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst' ></i></button>

    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>

</body>

</html>