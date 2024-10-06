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
?>

<!DOCTYPE html>
<html>
    <head>
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
        <?php include("./navbarU.php") ?>

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
            <form action="#" method="GET">
                <input type="text" name="query" placeholder="Search Organizations...">
                <button type="submit"><i class="ri-search-line"></i></button>
            </form>
            <a href="./U_seminar.php" id="button-30"><i class='bx bx-refresh' style="color:black"></i></a>
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
        
    <script src="" async defer></script>
    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>
    </body>
</html>