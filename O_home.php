<?php
    include("../../../BackEnd/db_con.php");
    include("../../../BackEnd/index_BE.php");
    session_start();
    $acc_id = $_SESSION['acc_id'];
    $fetchUnreadNotificationsQuery = "SELECT COUNT(*) as unread_count FROM notifications WHERE is_read = 0 AND org_id = (SELECT org_id FROM org_list WHERE acc_id = $acc_id)";
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
    <link rel="stylesheet" href="/FrontEnd/css/colors.css">
    <link rel="stylesheet" href="/FrontEnd/css/home.css">
    <link rel="stylesheet" href="/FrontEnd/css/navbar.css">
    <link rel="stylesheet" href="/FrontEnd/css/footer.css">
    <link rel="stylesheet" href="/FrontEnd/css/notification.css">
    <link rel="stylesheet" href="/FrontEnd/css/feedback.css">
    <link rel="icon" href="/Icons&logos/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Home</title>
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

    <div class="hero">
        <div class="section__container header__container">
            <h1>Join us to make Lives Better</h1>
            <p>
                A platform for Organizations. Stay connected with orphans and elderly to change lives with each click.
                Spread kindness to all.
            </p>
        </div>
        <div class="row diag-ro" id="info_web">
            <div class="about-diag" id="info_cell">
                <div class="icon"><i class="fas fa-arrow-right"></i></div>
                <div class="tex">
                    <p id="text">There are over</p>
                    <h3 id="count"><?php echo $total_orphans ?></h3>
                    <p id="text">orphans to help</p>
                </div>
            </div>
            <div class="about-diag" id="info_cell">
                <div class="icon"><i class="fas fa-arrow-right"></i></div>
                <div class="tex">
                    <p id="text">We have total</p>
                    <h3 id="count"><?php echo $total_organizations ?></h3>
                    <p id="text">organizations</p>
                </div>
            </div>
            <div class="about-diag" id="info_cell">
                <div class="icon"><i class="fas fa-arrow-right"></i></div>
                <div class="tex">
                    <p id="text">There are over</p>
                    <h3 id="count">12K</h3>
                    <p id="text">Volunteers</p>
                </div>
            </div>
            <div class="about-diag" id="info_cell">
                <div class="icon"><i class="fas fa-arrow-right"></i></div>
                <div class="tex">
                    <p id="text">We serverd over</p>
                    <h3 id="count"><?php echo $total_donation_Serverd ?></h3>
                    <p id="text">BDT as Donation</p>
                </div>
            </div>
        </div>
    </div>

    <div class="highlights">
        <p>need works for seminar and notice highlights</p>
    </div>


    <div class="container">
        <div class="options">
            <a href="create_blog.php" id="button-30">CreatePost</a>
        </div>
        <?php
            include('../../../BackEnd/blog_show_BE.php');
        ?>
    </div>

    <?php include "../../components/footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst' ></i></button>

    <script src="/FrontEnd/js/scrollupBTN.js"></script>
    <script src="/FrontEnd/js/notification_color.js"></script>
    <script src="/FrontEnd/js/feedback.js"></script>

</body>

</html>