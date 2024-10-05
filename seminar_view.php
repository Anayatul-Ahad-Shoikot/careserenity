<?php
    include('./db_con.php');
    session_start();
    $acc_id = $_SESSION['acc_id'];
    $role = $_SESSION['role'];
    if($role === 'org') {
        $fetchUnreadNotificationsQuery = "SELECT COUNT(*) as unread_count FROM notifications WHERE is_read = 0 AND org_id = (SELECT org_id FROM org_list WHERE acc_id = $acc_id)";
        $unreadNotificationsResult = mysqli_query($con, $fetchUnreadNotificationsQuery);
        $unreadCount = 0;
        if ($unreadNotificationsResult) {
            $unreadRow = mysqli_fetch_assoc($unreadNotificationsResult);
            $unreadCount = $unreadRow['unread_count'];
        }
    } else {
        $fetchUnreadNotificationsQuery = "SELECT COUNT(*) as unread_count FROM notifications WHERE is_read = 0 AND user_id = (SELECT user_id FROM user_list WHERE acc_id = $acc_id)";
        $unreadNotificationsResult = mysqli_query($con, $fetchUnreadNotificationsQuery);
        $unreadCount = 0;
        if ($unreadNotificationsResult) {
            $unreadRow = mysqli_fetch_assoc($unreadNotificationsResult);
            $unreadCount = $unreadRow['unread_count'];
        }
    }
    $query = "SELECT user_id FROM user_list WHERE acc_id = $acc_id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $role = $_SESSION['role'];
    $seminar_id = $_GET['seminar_id'];
    $org_id = $_GET['org_id'];
    $query2 = "SELECT * FROM seminars WHERE seminar_id = $seminar_id AND org_id = $org_id";
    $result2 = mysqli_query($con, $query2);
    $row2 = mysqli_fetch_assoc($result2);
    $query3 = "SELECT * FROM org_list WHERE org_id = $org_id";
    $result3 = mysqli_query($con, $query3);
    $row3 = mysqli_fetch_assoc($result3);
    $org_name = $row3['org_name'];
    $org_location = $row3['org_location'];
    $org_phone = $row3['org_phone'];
    $org_email = $row3['org_email'];
    $org_vision = $row3['org_vision'];
    $org_description = $row3['org_description'];
    $org_logo = $row3['org_logo'];
    $est = $row3['established'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/colors.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/orphan_profile.css">
    <link rel="stylesheet" href="./css/seminar_view.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/feedback.css">
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <title>Seminar registration</title>
</head>
<body>


    <?php 
        if ($role === 'user') {
            include "./navbarU.php";
        } else {
            include "./navbarO.php";
        } 
    ?>

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
        <div class="accounnt-information-container">
            <div class="account-picture">
                <img src="./assets/<?php echo $org_logo ?>" alt="profile">
            </div>
            <div class="account-data">
                <h1><?php echo $org_name ?></h1>
                <p>Location : <?php echo $org_location ?></p>
                <p>Email : <?php echo $org_email ?></p>
                <p>Contact : <?php echo $org_phone ?></p>
                <p>Established : <?php echo $est ?></p>
            </div>
            <div class="biography">
                <h1><?php echo $org_vision ?></h1>
                <p><?php echo $org_description ?></p>
            </div>
        </div>

        <div class="options">
            <?php 
                if ($role === 'user') {
                    echo '<a href="./u_seminar.php" id="button-30">back</a>';
                } else {
                    echo '<a href="./O_seminar.php" id="button-30">back</a>';
                }
            ?>
        </div>

        <div class="card border-0">
            <div class="position-relative text-white">
                <div class="card-img-overlay three" style="background-image:url('./assets/<?php echo $row2['banner'] ?>')"><span class="badge badge-light text-uppercase"><?php echo $row2['seminar_date'] ?></span></div>
                <div class="card-smooth-caption">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="mr-auto">
                    <h5 class="card-title text-white"><?php echo $row2['title'] ?></h5>
                    <p><?php echo $row2['subject'] ?></p>
                    </div>
                </div>
                </div>
            </div>
            <div class="card-body">
                <p id="guest">Special Guest : <?php echo $row2['guest'] ?></p>
                <p><?php echo $row2['description'] ?></p>
                <p id="location"><?php echo $row2['type'] == "online" ? "**[ Will be held Online ]**" : "**[ Location: {$row2['location']} ]**"; ?></p>
                <?php
                    if ($role == 'user') {
                        echo '<div style="display :flex; gap: 20px;">';
                            include './db_con.php';
                            $user_id = $row['user_id'];
                            $checkQuery = "SELECT * FROM seminar_participants WHERE seminar_id = $seminar_id AND participant_id = $user_id";
                            $checkResult = mysqli_query($con, $checkQuery);
                            if (mysqli_num_rows($checkResult) > 0) {
                                echo '<a href="./seminar_deregister_BE.php?seminar_id=' . $seminar_id . '&user_id=' . $user_id . '" class="cancel" id="button-30">Cancel Registration</a>';
                            } else {
                                echo '<a href="./seminar_register_BE.php?seminar_id=' . $seminar_id . '&user_id=' . $user_id . '" class="register" id="button-30">Register</a>';
                            }
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>

    <?php include "./footer.php" ?>
    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst' ></i></button>
    
    
    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>
    <script>
        function returnHome(x) {
            console.log(x);
            if (x == 'user'){
                window.location.href = './U_home.php';
            } else {
                window.location.href = './O_home.php';
            }
        }

        const creditCardInputs = document.getElementById("creditCardInputs");
        const bkashInputs = document.getElementById("bkashInputs");
        const bkashRadio = document.getElementById("bc2");
        const creditCardRadio = document.getElementById("bc1");

        function handlePaymentMethodChange() {
            if (bkashRadio.checked) {
                creditCardInputs.style.display = "none";
                bkashInputs.style.display = "block";
                document.getElementsByName("bkash_no")[0].setAttribute("required", "required");
                document.getElementsByName("Bkash_trans")[0].setAttribute("required", "required");
                document.getElementsByName("card_no")[0].removeAttribute("required");
                document.getElementsByName("card_cvc")[0].removeAttribute("required");
                document.getElementsByName("card_exp_month")[0].removeAttribute("required");
                document.getElementsByName("card_exp_year")[0].removeAttribute("required");
            } else if (creditCardRadio.checked) {
                creditCardInputs.style.display = "block";
                bkashInputs.style.display = "none";
                document.getElementsByName("card_no")[0].setAttribute("required", "required");
                document.getElementsByName("card_cvc")[0].setAttribute("required", "required");
                document.getElementsByName("card_exp_month")[0].setAttribute("required", "required");
                document.getElementsByName("card_exp_year")[0].setAttribute("required", "required");
                document.getElementsByName("bkash_no")[0].removeAttribute("required");
                document.getElementsByName("Bkash_trans")[0].removeAttribute("required");
            }
        }

        const paymentRadios = document.querySelectorAll('input[name="pay"]');
        paymentRadios.forEach((radio) => {
            radio.addEventListener("change", handlePaymentMethodChange);
        });
        handlePaymentMethodChange();
    </script>
</body>
</html>