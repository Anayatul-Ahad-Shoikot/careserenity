<?php
include("../../../BackEnd/adoption_request_details_BE.php");
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
    <link rel="stylesheet" href="/FrontEnd/css/adoption_request_details.css">
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
        <div class="img">
            <div class="im1">
                <img src="../../Dashboards/Own-Profiles/User/<?php echo $aplicant_image ?>" alt="" width="250px" height="250px">
            </div>
            <div class="im1">
                <img src="../../Orphanage/<?php echo $orphan_image ?>" alt="" width="250px" height="250px">
            </div>
        </div>

        <div class="img">
            <div class="name">
                <h4><?php echo $user_name ?></h4>
            </div>
            <div class="name">
                <h4><?php echo $first_name, ' ', $last_name ?></h4>
            </div>
        </div>
        <h2>Adoption Application Form</h2>
        <form action="#" method="POST">
            <div class="part">
                <label>Requested At:</label>
                <input type="text" placeholder="<?php echo $request_date ?>" disabled>
                <label>Adoption Process:</label>
                <input type="text" placeholder="<?php echo $status ?>" disabled>
                <label>Applicant's Email:</label>
                <input type="text" placeholder="<?php echo $email ?>" disabled>
                <label>Applicant's Phone Number:</label>
                <input type="text" placeholder="<?php echo $phone ?>" disabled>
                <label>Applicant's Occupation:</label>
                <input type="text" placeholder="<?php echo $occupation ?>" disabled>
                <label>Applicant's Annual Income:</label>
                <input type="text" placeholder="<?php echo $income ?>" disabled>
            </div>
            <div class="part">
                <label>Applicant's Marital Status:</label>
                <input type="text" placeholder="<?php echo $maritalStatus ?>" disabled>
                <label>Reason for Adoption:</label>
                <input type="text" placeholder="<?php echo $reason ?>" disabled>
                <label>Applicant's Current Children (if any):</label>
                <input type="text" placeholder="<?php echo $children ?>" disabled>
                <label>Description of Living Environment:</label>
                <input type="text" placeholder="<?php echo $livingEnvironment ?>" disabled>
                <label>Expectations as Adoptive Parents:</label>
                <input type="text" placeholder="<?php echo $expectations ?>" disabled>
                <label>Additional Information:</label>
                <input type="text" placeholder="<?php echo $additionalInfo ?>" disabled>
            </div>
        </form>
    </div>

    <?php include "../../components/footer.php" ?>

    <button id="scrollTopBtn" title="Go to top">↑</button>

    <script src="/FrontEnd/js/scrollupBTN.js"></script>
    <script src="/FrontEnd/js/notification_color.js"></script>
    <script src="/FrontEnd/js/feedback.js"></script>

</body>

</html>