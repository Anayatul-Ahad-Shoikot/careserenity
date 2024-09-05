<?php
include("../../../BackEnd/organization_profile_fetch_BE.php");
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
    <link rel="stylesheet" href="/FrontEnd/css/navbar.css">
    <link rel="stylesheet" href="/FrontEnd/css/profile_edit.css">
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
        <h2>Profile Information</h2>
        <form action="../../../BackEnd/Organization_profile_edit_BE.php" method="post" enctype="multipart/form-data">
            <div class="form_row">
                <label>Organization's Name :</label>
                <input type="text" name="org_name" placeholder="<?php echo $org_name ?>">
            </div>
            <div class="form_row">
                <label>Description :</label>
                <input type="text" name="org_description" placeholder="<?php echo $org_description ?>">
            </div>
            <div class="form_row">
                <label>Organization's Email :</label>
                <input type="text" name="org_email" placeholder="<?php echo $org_email ?>">
            </div>
            <div class="form_row">
                <label>Organization Contact :</label>
                <input type="text" name="org_phone" placeholder="<?php echo $org_phone ?>">
            </div>
            <div class="form_row">
                <label>Orgamization's Address :</label>
                <input type="text" name="org_location" placeholder="<?php echo $org_location ?>">
            </div>
            <div class="form_row">
                <label>Organization's Website :</label>
                <input type="text" name="org_website" placeholder="<?php echo $org_website ?>">
            </div>
            <div class="form_row">
                <label>Vision :</label>
                <input type="text" name="org_vision" placeholder="<?php echo $org_vision ?>">
            </div>
            <div class="form_row">
                <label>Orginization's Logo :</label>
                <input type="file" name="image" accept="image/*">
            </div>
            <div class="form_row">
                <label>Established At :</label>
                <input type="date" name="established">
            </div>
            <div class="btn">
                <button type="submit" name="update" id="button-30">Update</button>
            </div>
        </form>
    </div>

    <?php include "../../components/footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst' ></i></button>

    <script src="/FrontEnd/js/scrollupBTN.js"></script>
    <script src="/FrontEnd/js/notification_color.js"></script>
    <script src="/FrontEnd/js/feedback.js"></script>
</body>

</html>