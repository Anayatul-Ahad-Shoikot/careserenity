<?php
    include("./O_seminar_edit_BE.php");
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
    <link rel="stylesheet" href="./css/profile_edit.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/feedback.css">
    <link rel="icon" href="./assets/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Seminar </title>
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
        <form action="" method="POST" enctype="multipart/form-data">
        <label for="title">Seminar Title:</label>
            <input type="text" id="title" name="title" placeholder="<?php echo $title ?>">

            <label for="banner">Seminar Banner:</label>
            <input type="file" id="baner" name="banner" placeholder="<?php echo $banner ?>">

            <label for="description">Seminar Description:</label>
            <input type="text" name="description" id="description" placeholder="<?php echo $description ?>" >

            <label for="seminar_date">Date:</label>
            <input type="date" id="seminar_date" name="seminar_date" placeholder="<?php echo $seminar_date ?>">

            <label for="subject">Seminar Topic:</label>
            <input type="text" id="subject" name="subject" placeholder="<?php echo $subject ?>">

            <label for="guest">Guests:</label>
            <input type="text" id="guest" name="guest" placeholder="<?php echo $guest ?>">

            <label for="type">Type:</label>
            <select name="type" id="type" onchange="toggleLocatoinField()" placeholder="<?php $type ?>">
                <option value="online">Online</option>
                <option value="offline">Offline</option>
            </select>

            <div id="locationField" style="display: none;">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location">
            </div>

            <input type="submit" value="Create Seminar">
        </form>
    </div>

    <?php include "./footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst' ></i></button>

    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>
    <script src="./js/seminar_options.js"></script>
</body>

</html>