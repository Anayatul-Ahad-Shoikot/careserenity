<?php
    include("./db_con.php");
    session_start();
    $acc_id = $_SESSION['acc_id'];
    $fetchUnreadNotificationsQuery = "SELECT COUNT(*) as unread_count FROM notifications WHERE is_read = 0 AND user_id = (SELECT user_id FROM user_list WHERE acc_id = $acc_id)";
    $unreadNotificationsResult = mysqli_query($con, $fetchUnreadNotificationsQuery);
    $unreadCount = 0;
    if ($unreadNotificationsResult) {
        $unreadRow = mysqli_fetch_assoc($unreadNotificationsResult);
        $unreadCount = $unreadRow['unread_count'];
    }
    if(isset($_GET['orphan_id'])){
        $orphan_id = $_GET['orphan_id'];
    } else {
        $orphan_id = 0;
    }
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> CareSenerity.org | Donate </title>
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/colors.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/donation.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/feedback.css">
    <link rel="icon" href="./assets/LOGO.png" type="image/x-icon">

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
            <a href="./U_organization.php" id="button-30">back</a>
        </div>
        <section>
            <h1>We Receive Donations like..</h1>
            <div class="row">
                <div class="don-box">
                    <img src="./assets/salary.png" alt="img">
                    <h3>Fund</h3>
                    <p>Supports our organization's growth and development</p>
                    <a href="donation_form.php?org_id=<?php echo $_GET['org_id'] ?>&orphan_id=<?php echo $orphan_id ?>" id="button-30" class="fund">Donate Now</a>
                </div>
                <div class="don-box">
                    <img src="./assets/shopping-bag.png" alt="img">
                    <h3>Food</h3>
                    <p>Aids our orphans in overcoming hunger and maintaining good health</p>
                    <a href="#contact" id="button-30">Donate Now</a>
                </div>
            </div>
            <div class="row">
                <div class="don-box">
                    <img src="./assets/clothing.png" alt="img">
                    <h3>Clothes</h3>
                    <p>Empowers our orphans by providing them with clothing for a better appearance and confidence</p>
                    <a href="#contact" id="button-30">Donate Now</a>
                </div>
                <div class="don-box">
                    <img src="./assets/sneakers.png" alt="img">
                    <h3>Footware</h3>
                    <p>Assists our orphans in acquiring footwear for comfort and style</p>
                    <a href="#contact" id="button-30">Donate Now</a>
                </div>
                <div class="don-box">
                    <img src="./assets/book.png" alt="img">
                    <h3>Stationary</h3>
                    <p>Enables our orphans to access essential stationery for their educational pursuits</p>
                    <a href="#contact" id="button-30">Donate Now</a>
                </div>
            </div>
        </section>
    </div>

    <!-- Popup Form -->
    <div id="popupForm" class="popup">
        <div class="popup-content">
            <span class="close" onclick="togglePopup()">&times;</span>
            <div class="wrapper">
                <h1>Donation Form</h1>
                <form action="./donation_submit_BE.php" method="POST">
                    <div class="input_group">
                        <div class="input_box">
                            <input type="text" name="donor_email" placeholder="Email Address" required class="name">
                            <i class="fa fa-envelope icon"></i>
                        </div>
                    </div>
                    <div class="input_group" style="display: flex; flex-direction: column;">
                        <h4>Payment Method</h4>
                        <div class="input_box">
                            <input type="radio" name="pay" class="radio" id="bc1" value="card" checked>
                            <label for="bc1">
                                <span>Credit Card</span>
                            </label>
                            <input type="radio" name="pay" class="radio" id="bc2" value="bkash">
                            <label for="bc2">
                                <span>Bkash</span>
                            </label>
                        </div>
                    </div>
                    <div id="creditCardInputs">
                        <div class="input_group">
                            <div class="input_box">
                                <input type="text" name="card_no" class="name" placeholder="Card Number" required>
                                <i class="fa fa-credit-card icon"></i>
                            </div>
                        </div>
                        <div class="input_group">
                            <div class="input_box">
                                <input type="text" name="card_cvc" class="name" placeholder="Card CVC" required>
                                <i class="fa fa-user icon"></i>
                            </div>
                        </div>
                        <div class="input_group">
                            <div class="input_box">
                                <div class="input_box">
                                    <input type="text" name="card_exp_month" placeholder="Exp Month" required class="name">
                                    <i class="fa fa-calendar icon"></i>
                                </div>
                            </div>
                            <div class="input_box">
                                <input type="text" name="card_exp_year" placeholder="Exp Year" required class="name">
                                <i class="fa fa-calendar-o icon"></i>
                            </div>
                        </div>
                    </div>
                    <div id="bkashInputs" style="display: none;">
                        <div class="input_group">
                            <div class="input_box">
                                <input type="text" name="bkash_no" class="name" placeholder="Bkash Number" required>
                                <i class="fa fa-phone icon"></i>
                            </div>
                        </div>
                        <div class="input_group">
                            <div class="input_box">
                                <input type="text" name="Bkash_trans" class="name" placeholder="Transection ID" required>
                                <i class="fa fa-sort-numeric-desc icon"></i>
                            </div>
                        </div>
                    </div>
                    <div class="input_group">
                        <div class="input_box">
                            <input class="name" type="text" name="amount" placeholder="Donation Amount" required>
                            <i class="fa fa-money icon"></i>
                            <input type="hidden" name="org_id" value="<?php echo $_GET['org_id'] ?>">
                            <input type="hidden" name="orphan_id" value="<?php echo $orphan_id ?>">
                        </div>
                    </div>
                    <div class="input_group">
                        <div class="input_box">
                            <button type="submit" name="donate" id="button-30">Donate</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
        <?php include "./footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst' ></i></button>

    <script src="./js/donation_form.js"></script>
    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>
</body>

</html>