<?php
    session_start();
    include ('./db_con.php');
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
    <link rel="stylesheet" href="./css/terms&cons.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/feedback.css">
    <link rel="icon" href="./assets/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Terms & conditions </title>
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
        <h1>Terms & Conditions</h1>
        <p>These terms and conditions govern your use of CareSenerity.org. By using the Website, you agree to these Terms. If you disagree with any part of these Terms, please do not use the Website.</p>
        <ul>
            <h2>Adoption Terms:</h2>
            <li class="outerli">
                <h3>Eligibility:</h3>
                <ul class="xyz">
                    <li class="innerli">
                        <p>Prospective adoptive parents must comply with the legal requirements of their jurisdiction for adopting a child.</p>
                    </li>
                    <li  class="innerli">
                        <p>The Organization reserves the right to verify the eligibility and suitability of prospective adoptive parents through a screening process.</p>
                    </li>
                </ul>
            </li>
            <li class="outerli">
                <h3>Child Placement:</h3>
                <ul class="xyz">
                    <li class="innerli">
                        <p>The Organization will facilitate the adoption process while adhering to all relevant laws and regulations.</p>
                    </li>
                    <li class="innerli">
                        <p>The placement of a child will be based on compatibility, welfare, and the best interest of the child.</p>
                    </li>
                </ul>
            </li>
            <li class="outerli">
                <h3>Adoption Process:</h3>
                <ul class="xyz">
                    <li class="innerli">
                        <p>Prospective parents must complete and submit all required documentation accurately and honestly.</p>
                    </li>
                    <li class="innerli">
                        <p>The Organization will provide guidance and support throughout the adoption process, including necessary legal procedures.</p>
                    </li>
                </ul>
            </li>
            <li class="outerli">
                <h3>Home Study and Assessment:</h3>
                <ul class="xyz">
                    <li class="innerli">
                        <p>Prospective adoptive parents may undergo a home study or assessment conducted by the Organization or authorized professionals to ensure a safe and suitable environment for the child.</p>
                    </li>
                </ul>
            </li>
            <li class="outerli">
                <h3>Post-Adoption Support:</h3>
                <ul class="xyz">
                    <li class="innerli">
                        <p>The Organization may offer post-adoption support services to assist adoptive families in adjustment and addressing any challenges that may arise.</p>
                    </li>
                </ul>
            </li>
        </ul>
        <br>
        <ul>
            <h2 class="abc">Organization Rules:</h2>
            <li class="outerli">
                <h3>Privacy and Confidentiality:</h3>
                <ul class="xyz">
                    <li class="innerli">
                        <p>All information provided by users during the adoption process will be treated with strict confidentiality and used solely for adoption-related purposes.</p>
                    </li>
                </ul>
            </li>
            <li class="outerli">
                <h3>User Conduct:</h3>
                <ul class="xyz">
                    <li class="innerli">
                        <p>Users must not engage in any unlawful or inappropriate behavior on the Website.</p>
                    </li>
                    <li class="innerli">
                        <p>The Organization reserves the right to refuse service, terminate accounts, or cancel adoptions if users violate these Terms.</p>
                    </li>
                </ul>
            </li>
            <li class="outerli">
                <h3>Liability:</h3>
                <ul class="xyz">
                    <li class="innerli">
                        <p>The Organization shall not be held responsible for any misinformation provided by users or outcomes resulting from the adoption process.</p>
                    </li>
                </ul>
            </li>
            <li class="outerli">
                <h3>Changes to Terms:</h3>
                <ul class="xyz">
                    <li class="innerli">
                        <p>The Organization reserves the right to modify these Terms at any time. Users will be notified of any changes.</p>
                    </li>
                </ul>
            </li>
        </ul>
        <br>
        <ul>
            <h2>Disclaimer:</h2>
            <li class="outerli">
                <p>These terms and conditions are for informational purposes only and do not constitute legal advice. Users are encouraged to seek legal counsel for specific guidance related to adoption laws and regulations.</p>
            </li>
        </ul>
        <div class="buttons">
            <a href="./U_see_orphan_profile.php?orphan_id=<?php echo $_GET['orphan_id'] ?>" id="button-30">Decline</a>
            <a href="./U_adoption_form.php?orphan_id=<?php echo $_GET['orphan_id'] ?>" id="button-30">Continue</a>
        </div>
    </div>


    <?php include "./footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst'></i></button>


    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>
</body>

</html>