<?php
include("./U_adoption_request_details_BE.php");
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
        <a href="./U_profile.php" id="button-30">back</a>
    </div>

    <div class="form" id="aform">
        <div class="img" style="background-image:url('./assets/<?php echo $orphan_image ?>')">
            <div class="overlay"></div>
            <h1 class="name"><?php echo $first_name.' '.$last_name ?></h1>
            <p class="org"><?php echo $org_name ?></p>
        </div>
        <h2>Adoption Application Form</h2>
        <form>
            <div class="form_row">
                <label>Organization Email:</label>
                <input type="text" placeholder="<?php echo $org_email ?>" disabled>
            </div>
            <div class="form_row">
                <label>Organization Contact:</label>
                <input type="text" placeholder="<?php echo $org_phone ?>" disabled>
            </div>

            <div class="form_row">
                <label>Requested At:</label>
                <input type="text" placeholder="<?php echo $request_date ?>" disabled>
            </div>
            <div class="form_row">
                <label>Adoption Process:</label>
                <input type="text" id="adoptionStatus" placeholder="<?php 
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


            <div class="btn">
                <a href="./U_delete_adoption_request_BE.php?adoption_id=<?php echo $_GET['adoption_id'] ?>" id="button-30">Delete</a>
            </div>
        </form>
        </div>
    </div>

    <?php include "./footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst' ></i></button>

    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const adoptionStatus = document.getElementById('adoptionStatus').placeholder;
            const deleteButton = document.querySelector('.container form .buttons a');

            if (adoptionStatus === 'Approved') {
                deleteButton.style.pointerEvents = 'none';
                deleteButton.style.opacity = '0.5';
                deleteButton.style.backgroundColor = 'lightgrey';
            }
        });
    </script>

</body>

</html>