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
                <a href="./U_adoption.php" id="button-30">Refresh</a>
                <form action="#" method="GET">
                    <input type="text" name="query" placeholder="Search Organizations...">
                    <button type="submit"><i class="ri-search-line"></i></button>
                </form>
        </div>
        <!-- <div class="plate"> -->
            <?php
                include('./db_con.php');
                if(isset($_GET['query'])){
                    $searchTerm = $_GET['query'];
                    $query = "SELECT orphan_image, first_name, last_name, orphan_id, org_id FROM orphan_list 
                                WHERE first_name LIKE '%$searchTerm%' 
                                OR last_name LIKE '%$searchTerm%'
                                OR age LIKE '%$searchTerm%' OR gender LIKE '%$searchTerm%' OR religion LIKE '%$searchTerm%'";
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result) > 0) {
                        echo '<div class="plate">';
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
                        echo '</div>';
                    } else {
                        echo '<p id="notFound">No orphans found</p>';
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