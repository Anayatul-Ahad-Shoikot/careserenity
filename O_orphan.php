<?php
    include("../../../BackEnd/organization_profile_fetch_BE.php");
    $acc_id = $_SESSION['acc_id'];
    $fetchUnreadNotificationsQuery = "SELECT COUNT(*) as unread_count FROM notifications WHERE is_read = 0 AND org_id = (SELECT org_id FROM org_list WHERE acc_id = ?)";
    $stmt = $con->prepare($fetchUnreadNotificationsQuery);
    $stmt->bind_param('i', $acc_id);
    $stmt->execute();
    $stmt->bind_result($unreadCount);
    $stmt->fetch();
    $stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet" href="/FrontEnd/css/colors.css">
    <link rel="stylesheet" href="/FrontEnd/css/navbar.css">
    <link rel="stylesheet" href="/FrontEnd/css/orphan.css">
    <link rel="stylesheet" href="/FrontEnd/css/footer.css">
    <link rel="stylesheet" href="/FrontEnd/css/notification.css">
    <link rel="stylesheet" href="/FrontEnd/css/feedback.css">
    <link rel="icon" href="/Icons&logos/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Profile </title>
</head>

<body>

    <?php include "../../components/navbarO.php" ?>

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

        <div class="accounnt-information-container">
            <div class="account-picture">
                <img src="../../../UserImage/accountPic/<?php echo $org_logo ?>" alt="profile" width="250px" height="250px">
            </div>
            <div class="account-data">
                    <h1><?php echo $org_name ?></h1>
                    <p>Location : <?php echo $org_location ?>, Bangladesh</p>
                    <p>Email : <?php echo $org_email ?></p>
                    <p>Contact : <?php echo $org_phone ?></p>
                    <p>Established : <?php echo $established ?>, Joined : <?php echo $acc_join_date ?></p>
                    <p>Account Type : <?php echo $role ?></p>
            </div>
            <div class="biography">
                <h1><?php echo $org_vision ?></h1>
                <p><?php echo $org_description ?></p>
            </div>
        </div>
        
        <div class="options">
            <a href="profile.php" id="button-30">back</a>
            <a href="orphan_removed.php" id="button-30">Removed Child</a>
            <a href="orphan_add.php" id="button-30">Add Child</a>
            <form action="../../../BackEnd/orphan_search_organization_BE.php" method="GET">
                <input type="text" name="query" placeholder="Search Child...">
                <button type="submit"><i class='bx bx-search bx-rotate-90' ></i></button>
            </form>
        </div>

        <div class="plate">
            <?php
            if (isset($_SESSION['search_results'])){
                foreach ($_SESSION['search_results'] as $row) {
                    echo '<div class="card">';
                    echo '<div class="pb" style="background-image: url(\'/UserImage/childpic/' . htmlspecialchars($row['orphan_image']) . '\');"></div>';
                    echo '<div class="info">';
                    echo '<h1>' . htmlspecialchars($row['first_name']) . '</h1>';
                    echo '</div>';
                    echo '<div class="buttons">';
                    echo '<a href="/BackEnd/orphan_remove_organization_BE.php?orphan_id=' . htmlspecialchars($row['orphan_id']) . '" id="button-30">Remove</a>';
                    echo '<a href="/FrontEnd/loggedIn/organizationpage/orphan_profile.php?orphan_id=' . htmlspecialchars($row['orphan_id']) . '" id="button-30">View</a>';
                    echo '</div>';
                    echo '</div>';
                }
                unset($_SESSION['search_results']);
            } else {
                include ('../../../BackEnd/orphan_view_organization_BE.php');
            }
            ?>
        </div>

    </div>

    <?php include "../../components/footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst' ></i></button>

    <script src="/FrontEnd/js/scrollupBTN.js"></script>
    <script src="/FrontEnd/js/notification_color.js"></script>
    <script src="/FrontEnd/js/feedback.js"></script>
</body>

</html>