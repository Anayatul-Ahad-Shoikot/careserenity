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
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/feedback.css">
    <link rel="stylesheet" href="./css/cards.css">
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
        <div class="accounnt-information-container">
            <div class="account-picture">
                <img src="./assets/<?php echo $user_image ?>" alt="profile">
            </div>
            <div class="account-data">
                <h1><?php echo $user_name ?></h1>
                <p>Location : <?php echo $user_address, ", ", $user_location ?></p>
                <p>Email : <?php echo $acc_email ?></p>
                <p>Contact : <?php echo $user_contact ?></p>
                <p>Account Type : <?php echo $role ?></p>
            </div>
            <div class="biography">
                <h1>Occupation</h1>
                <p><?php echo $user_job ?></p>
                </p>
            </div>
        </div>

        <div class="options">
            <a href="#" id="button-30">Chats</a>
            <a href="#" id="button-30">Volunteers</a>
            <a href="./U_profile_edit.php" id="button-30">Profile Info</a>
        </div>

        <div class="short-reports">
            <h1 id="heading">Adoption requests :</h1>
            <div class="ag-format-container">
                <div class="ag-courses_box">
                    <?php include './U_fetch_adoption_cards_BE.php'; ?>
                </div>
            </div>

            <h1 id="heading">Seminar :</h1>
            <div class="ag-format-container">
                <div class="card_boxes">
                <?php
                    include("db_con.php");
                    $query = "SELECT S.* FROM seminars AS S LEFT JOIN seminar_participants as SP ON S.seminar_id = SP.seminar_id WHERE (SP.participant_id = {$user_id} AND S.isRemoved = 0 AND S.visibility = 0)";
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row1 = mysqli_fetch_assoc($result)) {
                            echo '
                            <div class="card">
                                <div class="card_price">' . $row1['seminar_date'] . '</div>
                                <div class="card_image">
                                    <img src="./assets/' . $row1['banner'] . '">
                                </div>
                                <div class="card_content">
                                    <h2 class="card_title">' . $row1['title'] . '</h2>
                                    <div class="card_text">
                                        <p>' . $row1['description'] . '</p>
                                    </div>
                                </div>
                            </div>';
                        }
                    } else {
                        echo "<p id='notFound'>Not added yet</p>";
                    }
                    mysqli_close($con);
                    ?>
                </div>
            </div>
        </div>
    </div>


    <?php include "./footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst'></i></button>

    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>
</body>

</html>