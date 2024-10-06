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
    <link rel="stylesheet" href="./css/profile_edit.css">
    <link rel="stylesheet" href="./css/seminar.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/feedback.css">
    <link rel="icon" href="./assets/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Seminars</title>
</head>

<body>

    <?php include("./navbarO.php") ?>

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
        <button onclick="showForm(this)" id="button-30">Create Seminar</button>
    </div>
    
    <div class="container" id="seminarForm" style="display: none;">
        <form action="./O_seminar_create_BE.php" method="POST" enctype="multipart/form-data" >
            <h2>Launch Seminar</h2>
            <div class="form_row">
                <label for="title">Seminar Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form_row">
                <label for="subject">Seminar Subject:</label>
                <input type="text" id="topic" name="subject" required>
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
                <label for="guest">Guests:</label>
                <input type="text" id="guest" name="guest" required>
            </div>
            <div class="form_row">
                <label for="type">Type:</label>
                <select name="type" id="type" onchange="toggleLocatoinField()" required>
                    <option value="none" selected disabled>Select online or offline</option>
                    <option value="online">Online</option>
                    <option value="offline">Offline</option>
                </select>
            </div>
            <div class="form_row" id="locationField" style="display: none;">
                <label for="location">Location:</label>
                <input type="text" id="location" name="location">
            </div>
            <div class="form_row">
                <label for="banner">Seminar Banner:</label>
                <input type="file" id="baner" name="banner" required>
            </div>
            <div class="buttons">
                <button id="button-30">Create</button>
            </div>
        </form>
    </div>

    <h1 id="heading">My Seminars :</h1>

    <div class="seminarBlock">
        <?php include('./O_seminar_own_fetch_BE.php') ?>
    </div>

    <h1 id="heading">Available Seminars :</h1>

    <div class="seminarBlock">
            <?php
                include("./db_con.php");
                $ownSeminarQuery = "SELECT seminars.*, COUNT(seminar_participants.seminar_id) as participants_count FROM seminars LEFT JOIN seminar_participants ON seminars.seminar_id = seminar_participants.seminar_id LEFT JOIN org_list ON org_list.org_id = seminars.org_id WHERE ( seminars.isRemoved = 0 AND seminars.isFinished = 0 AND seminars.visibility = 0 ) GROUP BY seminars.seminar_id";
                $result = mysqli_query($con, $ownSeminarQuery);                        
                if(mysqli_num_rows($result) > 0){
                    echo "<div class='cards'>";
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<a href='./seminar_view.php?seminar_id=" . $row['seminar_id'] . "&org_id=" . $row['org_id'] . "'><div class='seminarCard'>";
                        echo "<img src='./assets/".htmlspecialchars($row['banner'])."'alt='Seminar Banner'>";
                        echo "<h3>".htmlspecialchars($row['title'])."</h3>";
                        echo "<div class='info'><span>".htmlspecialchars($row['seminar_date'])."</span>";
                        echo "<span><i class='bx bxs-user-check'></i> ".htmlspecialchars($row['participants_count'])."</span></div>";
                        echo "</div></a>";
                    }
                    echo "</div>";
                }
                else{
                    echo "<p id='notFound'>Currently no seminars are available.</p>";
                }
            ?>
    </div>
    
    <?php include "./footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst'></i></button>

    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>
    <script src="./js/seminar_options.js"></script>

</body>

</html>