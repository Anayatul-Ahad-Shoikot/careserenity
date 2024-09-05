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
    <link rel="stylesheet" href="/FrontEnd/css/orphan_add.css">
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
        <h2>Register New Orphan</h2>
        <form action="../../../BackEnd/orphan_add_BE.php" method="post" enctype="multipart/form-data">

            <div class="basic_info">
                <input type="text" name="first_name" placeholder="First Name" required>
                <input type="text" name="last_name" placeholder="Last Name" required>
                <input type="number" name="age" placeholder="Age" required>
                <input type="text" name="guardian_name" placeholder="Local Gaurdian's Name" required>
                <input type="text" name="guardian_contact" placeholder="Local Guardian's Contact Number" required>
                <input type="text" name="guardian_location" placeholder="Local Gaurdian's Address" required>
                <input type="text" name="medical_history" placeholder="Past Medical History" required>
                <input type="text" name="hobby" placeholder="Hobby" required>
                <input type="text" name="favorite_food" placeholder="Favourite Food" required>
                <input type="text" name="favorite_game" placeholder="Favourite Game" required>
                <input type="text" name="skills" placeholder="Skills">
                <input type="text" name="dreams" placeholder="Dreams">
                <input type="text" name="problems" placeholder="Problems">
                <input type="text" name="other_comments" placeholder="Other comments">
                <div class="part">
                    <label>Date of Birth :</label>
                    <input type="date" name="date_of_birth" required>
                </div>
                <div class="part">
                    <select name="gender" required>
                        <option value='' selected disabled>Select gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="part">
                    <select name="religion" required>
                        <option value='' selected disabled>Select religion</option>
                        <option value="muslim">Muslim</option>
                        <option value="hindu">Hindu</option>
                        <option value="cristian">Cristian</option>
                        <option value="buddha">Buddha</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div class="part">
                    <select name="family_status">
                        <option value='' selected disabled>Select family status</option>
                        <option value="abondoned">Abandoned</option>
                        <option value="past Away">Past Away</option>
                        <option value="unknow">Unknow</option>
                        <option value="lost">Lost</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="part">
                    <select name="physical_condition" required>
                        <option value='' selected disabled>Select physical condition</option>
                        <option value="good">Good</option>
                        <option value="blind">Blind</option>
                        <option value="deaf">Deaf</option>
                        <option value="disabled">Disabled</option>
                        <option value="autistic">Autistic</option>
                        <option value="mad">Mad</option>
                    </select>
                </div>
                <div class="part">
                    <select name="education_level">
                        <option value='' selected disabled>Select education level</option>
                        <option value="kindergarten">Kindergarten</option>
                        <option value="elementary">Elementary</option>
                        <option value="primary_school">Primary School</option>
                        <option value="junior_high_school">Junior High School</option>
                        <option value="senior_high_school">Senior High School</option>
                        <option value="secondary_school">secondary_school</option>
                    </select>
                </div>
                <div class="part">
                    <label>Image:</label>
                    <input type="file" name="image" accept="image/*" required>
                </div>
            </div>

            <div class="btn">
                <button type="submit" name="Register" id="button-30">Register</button>
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