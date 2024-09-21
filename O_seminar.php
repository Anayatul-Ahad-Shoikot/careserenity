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
    <link rel="stylesheet" href="./css/profile_edit.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/feedback.css">
    <link rel="icon" href="./assets/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Seminars</title>
</head>

<body>

    <?php include("./navbarO.php") ?>

    <button id="createSeminar" onclick="showForm()">Create Seminar</button>

    <div class="container" id="seminarForm" style="display: none;">
        <h2>Launch Seminar</h2>
        <form action="./O_seminar_create_BE.php" method="POST" enctype="multipart/form-data" >
            <div class="form_row">
                <label for="title">Seminar Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form_row">
                <label for="banner">Seminar Banner:</label>
                <input type="file" id="baner" name="banner" required>
            </div>
            <div class="form_row">
                <label for="description">Seminar Description:</label>
                <input name="description" id="description" required>
            </div>
            <div class="form_row">
                <label for="seminar_date">Date:</label>
                <input type="date" id="date" name="seminar_date" required>
            </div>
            <div class="form_row">
                <label for="subject">Seminar Topic:</label>
                <input type="text" id="topic" name="subject" required>
            </div>
            <div class="form_row">
                <label for="guest">Guests:</label>
                <input type="text" id="guest" name="guest" required>
            </div>
            <div class="form_row">
                <label for="type">Type:</label>
                <select name="type" id="type" onchange="toggleLocatoinField()" required>
                    <option value="online">Online</option>
                    <option value="offline">Offline</option>
                </select>
            </div>
            <div class="form_row" id="locationField" style="display: none;">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location">
            </div>
            <div class="buttons">
                <button id="button-30">Create</button>
            </div>
            
        </form>
    </div>

        <div id="ownSeminar">
            <h2>Your Created Seminars</h2>

            <?php
            include("./db_con.php");
            $ownSeminarQuery = "SELECT seminars.*, COUNT(seminar_participants.seminar_id) as participants_count 
                                    FROM seminars 
                                    LEFT JOIN seminar_participants ON seminars.seminar_id = seminar_participants.seminar_id
                                    WHERE org_id = (SELECT org_id FROM org_list WHERE acc_id = $acc_id)
                                    GROUP BY seminars.seminar_id";

            ?>
        </div>

        <div id="allSeminars">
            <h2>All Seminars</h2>
            <?php
            include("./db_con.php");
            $seminarQuery = "SELECT * FROM seminars WHERE org_id != 
                                (SELECT org_id FROM org_list WHERE acc_id = $acc_id)";
            $seminarResult = mysqli_query($con, $seminarQuery);

            while ($row = mysqli_fetch_assoc($seminarResult)) {
                echo "<div class='seminarCard'>
                            <h3>{$row['title']}</h3>
                            <img src='{$row['banner']}' alt='Seminar Banner'>
                            <p>{$row['description']}</p>
                            <p>Date: {$row['seminar_date']}</p>
                            <p>Topic: {$row['row']}</p>
                            <p>Guest: {$row['guest']}</p>
                            <p>Type: {$row['type']}</p>";

                if ($row['type'] == 'offline') {
                    echo "<p>Location: {$row['location']}</p>";
                }
                echo "</div>";
            }
            ?>
        </div>
    <?php include "./footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst'></i></button>

    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>

    <script>
        function showForm() {
            const form = document.getElementById("seminarForm");
            form.style.display = 'block';
        }

        function toggleLocatoinField() {
            const type = document.getElementById("type").value;
            const locationField = document.getElementById("locationField");
            if (type == "offline") {
                locationField.style.display = 'flex';
            } else {
                locationField.style.display = 'none';
            }
        }
    </script>

</body>

</html>