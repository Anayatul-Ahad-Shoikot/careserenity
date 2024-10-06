<?php
include("./O_adoption_request_details_BE.php");
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
    <link rel="stylesheet" href="./css/orphan_profile.css">
    <link rel="stylesheet" href="./css/adoption_form.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/feedback.css">
    <link rel="icon" href="./assets/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Adoption Request </title>
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

    <div class="options">
        <a href="./O_adoption.php" id="button-30">back</a>
    </div>


    <div class="form" id="aform">
        <div class="img" style="background-image:url('./assets/<?php echo $user_image ?>')">
            <div class="overlay"></div>
            <h1 class="name"><?php echo $user_name ?></h1>
        </div>
        <h2>Adoption Application Form</h2>
        <form>
            <div class="form_row">
                <label>Requested by:</label>
                <input type="text" placeholder="<?php echo $user_name ?>" disabled>
            </div>
            <div class="form_row">
                <label>Requested At:</label>
                <input type="text" placeholder="<?php echo $request_date ?>" disabled>
            </div>
            <div class="form_row">
                <label>Adoption Process:</label>
                <input type="text" placeholder="<?php 
                    if($status == 1){
                        echo 'Approved';
                    } else if ($status == 2) {
                        echo 'Rejected';
                    } else {
                        echo 'Pending';
                    }
                ?>" disabled>
            </div>
            <div class="form_row">
                <label>Applicant's Email:</label>
                <input type="text" placeholder="<?php echo $email ?>" disabled>
            </div>
            <div class="form_row">
                <label>Applicant's Phone Number:</label>
                <input type="text" placeholder="<?php echo $phone ?>" disabled>
            </div>
            <div class="form_row">
                <label>Applicant's Occupation:</label>
                <input type="text" placeholder="<?php echo $occupation ?>" disabled>
            </div>
            <div class="form_row">
                <label>Applicant's Annual Income:</label>
                <input type="text" placeholder="<?php echo $income ?>" disabled>
            </div>
            <div class="form_row">
                <label>Requested for:</label>
                <input type="text" placeholder="<?php echo $first_name, ' ', $last_name ?>" disabled>
            </div>
            <div class="form_row">
                <label>Applicant's Marital Status:</label>
                <input type="text" placeholder="<?php echo $maritalStatus ?>" disabled>
            </div>
            <div class="form_row">
                <label>Reason for Adoption:</label>
                <input type="text" placeholder="<?php echo $reason ?>" disabled>
            </div>
            <div class="form_row">
                <label>Applicant's Current Children (if any):</label>
                <input type="text" placeholder="<?php echo $children ?>" disabled>
            </div>
            <div class="form_row">
                <label>Description of Living Environment:</label>
                <input type="text" placeholder="<?php echo $livingEnvironment ?>" disabled>
            </div>
            <div class="form_row">
                <label>Expectations as Adoptive Parents:</label>
                <input type="text" placeholder="<?php echo $expectations ?>" disabled>
            </div>
            <div class="form_row">
                <label>Additional Information:</label>
                <input type="text" placeholder="<?php echo $additionalInfo ?>" disabled>
            </div>

            <div style="display: flex; justify-content:center; gap: 20px; text-align:center;">
                <a href="./O_adoption_request_accept_BE.php?adoption_id=<?php echo $_GET['adoption_id'] ?>&user_id=<?php echo $_GET['user_id'] ?>&orphan_id=<?php echo $_GET['orphan_id']?>" id="button-30">Accept</a>
                <a href="./O_adoption_request_reject_BE.php?adoption_id=<?php echo $_GET['adoption_id'] ?>&user_id=<?php echo $_GET['user_id'] ?>&orphan_id=<?php echo $_GET['orphan_id']?>" id="button-30">Reject</a>
            </div>
        </form>
        </div>
    </div>

    <?php include "./footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst' ></i></button>

    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>

</body>

</html>