<?php
    include("./O_profile_fetch_BE.php");
    include("./orphan_profile_fetch_BE.php");
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
    <link rel="stylesheet" href="./css/orphan_profile.css">
    <link rel="stylesheet" href="./css/adoption_form.css">
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

        <div class="options">
            <a href="./U_adoption.php" id="button-30">back</a>
        </div>

        <div class="form" id="aform">
            <div class="img" style="background-image:url('./assets/<?php echo $orphan_image ?>')">
                <div class="overlay"></div>
                <h1 class="name"><?php echo $first_name ?>  <?php echo $last_name ?></h1>
                <p class="org"><?php echo $org_name ?></p>
            </div>
            <h2>Adoption Application Form</h2>
            <form action="./U_adoption_form_BE.php" method="POST">
                <input type="hidden" name="orphan_id" value="<?php echo $_GET['orphan_id'] ?>">
                <input type="hidden" name="acc_id" value="<?php echo $acc_id ?>">
                <div class="form_row">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form_row">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form_row">
                    <label for="occupation">Occupation:</label>
                    <input type="text" id="occupation" name="occupation" required>
                </div>
                <div class="form_row">
                    <label for="income">Annual Income:</label>
                    <input type="number" id="income" name="income" required>
                </div>
                <div class="form_row">
                    <label for="maritalStatus">Marital Status:</label>
                    <select id="maritalStatus" name="maritalStatus" required>
                        <option value="">Select</option>
                        <option value="single">Single</option>
                        <option value="married">Married</option>
                        <option value="divorced">Divorced</option>
                        <option value="widowed">Widowed</option>
                    </select>
                </div>
                <div class="form_row">
                    <label for="reason">Reason for Adoption:</label>
                    <input type="text" id="reason" name="reason" required>
                </div>
                <div class="form_row">
                    <label for="children">Current Children (if any):</label>
                    <input type="text" id="children" name="children">
                </div>
                <div class="form_row">
                    <label for="livingEnvironment">Description of Living Environment:</label>
                    <input type="text" id="livingEnvironment" name="livingEnvironment" required>
                </div>
                <div class="form_row">
                    <label for="expectations">Expectations as Adoptive Parents:</label>
                    <input type="text" id="expectations" name="expectations" required>
                </div>
                <div class="form_row">
                    <label for="additionalInfo">Additional Information:</label>
                    <input type="text" id="additionalInfo" name="additionalInfo">
                </div>
                <div class="btn">
                    <button type="submit" name="submit" id="button-30">Submit</button>
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