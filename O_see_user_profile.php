<?php
    include("./see_user_profile_BE.php");
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
    <link rel="stylesheet" href="./css/colors.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/feedback.css">
    <link rel="icon" href="./assets/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Profile </title>
</head>

<body>

    <?php include "./navbarO.php" ?>

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
                <img src="./assets/<?php echo $user_image ?>" alt="profile">
            </div>
            <div class="account-data">
                <h1><?php echo $user_name ?></h1>
                <p>Location : <?php echo $user_address, ", ", $user_location ?></p>
                <p>Email : <?php echo $acc_email ?></p>
                <p>Contact : <?php echo $user_contact ?></p>
            </div>
            <div class="biography">
                <h1>Occupation</h1>
                <p><?php echo $user_job ?></p></p>
            </div>
        </div>

        <div class="options">
            <a href="#" id="button-30">Chats</a>
        </div>

        <div class="form">
            <h2>Profile Information</h2>
            <form>
                <div class="form_row">
                    <label>Full Name :</label>
                    <input placeholder="<?php echo $user_name ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Gender :</label>
                    <input placeholder="<?php echo $user_gender ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Date of Birth :</label>
                    <input placeholder="<?php echo $user_birth ?>" disabled>
                </div>
                <div class="form_row">
                    <label>NID Number :</label>
                    <input placeholder="<?php echo $user_NID ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Since :</label>
                    <input placeholder="<?php echo $acc_join_date ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Contact Number :</label>
                    <input placeholder="<?php echo $user_contact ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Web Site :</label>
                    <input placeholder="<?php echo $user_website ?>" disabled>
                </div>
            </form>
        </div>
    </div>

    <?php include "./footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst' ></button>

    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>
</body>

</html>