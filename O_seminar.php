<?php
include("./db_con.php");
session_start();
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
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="./css/aboutus.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/feedback.css">
    <link rel="icon" href="./assets/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Seminars</title>
</head>
<body>

    <?php include("./navbarO.php") ?>

    <!-- Main body -->

    <!-- seminar btn -->
    <button id="createSeminar" onclick="toggleSeminarForm()">Create Seminar</button>

    <!-- seminar form -->
    <div id="seminarForm" style="display: none;">
        <form action="" method="POST" enctype="multipart/form-data">
            <label for="title">Seminar Title:</label>
            <input type="text" id="title" name="title" required><br>

            <label for="banner">Seminar Banner:</label>
            <input type="file" id="baner" name="banner" required><br>

            <label for="description">Seminar Description:</label>
            <textarea name="description" id="description" required></textarea><br>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required><br>

            <label for="topic">Seminar Topic:</label>
            <input type="text" id="topic" name="topic" required><br>

            <label for="guest">Guests:</label>
            <input type="text" id="guest" name="guest" required><br>

            <label for="type">Type:</label>
            <select name="type" id="type" onchange="toggleLocatoinField()" required>
                <option value="online">Online</option>
                <option value="offline">Offline</option>
            </select><br>

            <div id="locationField" style="display: none;">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location"><br>
            </div>

            <input type="submit" value="Create Seminar">
        </form>
    </div>

    <!-- seminar tile section -->
    <div id="allSeminars">
        <h2>All Seminars</h2>

        <?php 
            $seminarQuery = "SELECT * FROM seminars WHERE org_id = 
                            (SELECT org_id FROM org_list WHERE acc_id = $acc_id) OR 
                            org_id IN (SELECT org_id FROM other_orgs)";
            $seminarResult = mysqli_query($con, $seminarQuery);

            while($row = mysqli_fetch_assoc($seminarResult)){
                echo "<div class='seminarCard'>
                        <h3>{$row['title']}</h3>
                        <img src='{$row['banner']}' alt='Seminar Banner'>
                        <p>{$row['description']}</p>
                        <p>Date: {$row['date']}</p>
                        <p>Topic: {$row['row']}</p>
                        <p>Guest: {$row['guest']}</p>
                        <p>Type: {$row['type']}</p>";

                if($row['type'] == 'offline'){
                    echo "<p>Location: {$row['location']}</p>";
                }
                echo "</div>";
            }
        ?>
    </div>

    <!-- created seminar section -->
    <div id="ownSeminar">
        <h2>Your Created Seminars</h2>

        <?php
            $ownSeminarQuery = "SELECT seminars.*, COUNT(participants.seminar_id) as participants_count 
                                FROM seminars 
                                LEFT JOIN participants ON seminars.seminar_id = participants.seminar_id
                                WHERE org_id = (SELECT org_id FROM org_list WHERE acc_id = $acc_id)
                                GROUP BY seminars.seminar_id";

        ?>
    </div>

    <!-- Main body end -->

    <?php include "./footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst' ></i></button>

    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>

    <script>
        function toogleSeminarForm() {
            var form = document.getElementById("seminarForm");
            form.style.display = form.style.display == "none" ? "block" : "none";
        }

        function toggleLocationField() {
            var type = document.getElementById("type").value;
            var locationField = document.getElementById("locatonField");
            if(type == "offline"){
                locationField.style.display = "block";
            }
            else{
                locationField.style.display = "none";
            }
        }
    </script>

</body>
</html>