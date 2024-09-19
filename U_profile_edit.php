<?php
include("./user_profile_fetch_BE.php");
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
    <link rel="stylesheet" href="./css/profile_edit.css">
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

    <div class="options">
        <a href="./U_profile.php" id="button-30">back</a>
    </div>


    <div class="container">
        <h2>Edit Profile</h2>
        <form action="./U_profile_edit_BE.php" method="post" enctype="multipart/form-data">
            <div class="form_row">
                <label>Full Name :</label>
                <input type="text" name="user_name" placeholder="<?php echo $user_name ?>" >
            </div>
            <div class="form_row">
                <label>Email :</label>
                <input type="text" name="user_contact" placeholder="<?php echo $acc_email ?>" >
            </div>
            <div class="form_row">
                <label>Contact :</label>
                <input type="text" name="user_contact" placeholder="<?php echo $user_contact ?>" >
            </div>
            <div class="form_row">
                <label>NID :</label>
                <input type="text" name="user_NID" placeholder="<?php echo $user_NID ?>" >
            </div>
            <div class="form_row">
                <label>Occupation :</label>
                <input type="text" name="user_job" placeholder="<?php echo $user_job ?>" >
            </div>
            <div class="form_row">
                <label> Address :</label>
                <input type="text" name="user_address"  placeholder="<?php echo $user_address ?>">
            </div>
            <div class="form_row">
                <label>Website (if any):</label>
                <input type="text" name="user_website" placeholder="<?php echo $user_website ?>" >
            </div>
            <div class="form_row">
                <label>Gender :</label>
                <select name="user_gender">
                    <option value=''><?php echo $user_gender ?></option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form_row">
                <label>Division :</label>
                <select name="user_location">
                        <option value="" disabled selected><?php echo $user_location ?></option>
                        <option value="Dhaka">Dhaka</option>
                        <option value="Chittagong">Chittagong</option>
                        <option value="Khulna">Khulna</option>
                        <option value="Barisal">Barisal</option>
                        <option value="Rajshahi">Rajshahi</option>
                        <option value="Sylhet">Sylhet</option>
                        <option value="Rangpur">Rangpur</option>
                </select>
            </div>
            <div class="form_row">
                <label>Birth Date :</label>
                <input type="date" name="user_birth" >
            </div>
            <div class="form_row">
                <label>Profile Picture :</label>
                <input type="file" name="image" accept="image/*">
            </div>
            <div class="btn">
                <button type="submit" name="update" id="button-30">Update</button>
            </div>
        </form>
    </div>

    <?php include "./footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst' ></i></button>

    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>
</body>

</html>