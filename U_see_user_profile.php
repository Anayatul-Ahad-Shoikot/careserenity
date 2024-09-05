<?php
session_start();
include("./get_user_profile_BE.php");
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
        <div class="accounnt-information-container">
                <div class="account-picture">
                    <img src="./assets/<?php echo $user_image ?>" alt="profile">
                </div>
                <div class="account-data">
                    <h1><?php echo $user_name ?></h1>
                    <p>Location : <?php echo $user_address, ", ", $user_location ?></p>
                    <p>Email : <?php echo $acc_email ?></p>
                    <p>Contact : <?php echo $user_contact ?></p>
                    <p>Account Type : <?php echo $role ?></p>
                </div>
                <div class="biography">
                    <h1>Occupation</h1>
                    <p><?php echo $user_job ?></p></p>
                </div>
        </div>
        <div class="options">
            <a href="#?user_id=<?php echo $user_id ?>" id="button-30">Inbox</a>
            <a href="#?user_id=<?php echo $user_id ?>" id="button-30">Report</a>
        </div>
        <div class="details">
            <form>
                <div class="form_row">
                    <label>Full Name :</label>
                    <input type="text" placeholder="<?php echo $user_name ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Email :</label>
                    <input type="text" placeholder="<?php echo $acc_email ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Contact :</label>
                    <input type="text" placeholder="<?php echo $user_contact ?>" disabled>
                </div>
                <div class="form_row">
                    <label>NID :</label>
                    <input type="text" placeholder="<?php echo $user_NID ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Occupation :</label>
                    <input type="text" placeholder="<?php echo $user_job ?>" disabled>
                </div>
                <div class="form_row">
                    <label> Address :</label>
                    <input type="text" placeholder="<?php echo $user_address ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Website :</label>
                    <input type="text" placeholder="<?php echo $user_website ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Gender :</label>
                    <input type="text" placeholder="<?php echo $user_gender ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Division :</label>
                    <input type="text" placeholder="<?php echo $user_location ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Birth Date :</label>
                    <input type="text"  placeholder="<?php echo $user_birth ?>" disabled>
                </div>
            </form>
        </div>
    </div>


    <?php include "./footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst'></i></button>

    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>
</body>

</html>