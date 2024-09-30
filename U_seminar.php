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
            <a href="./U_seminar.php" id="button-30">Refresh</a>
        </div>

        <h1 id="heading">Current Seminars</h1>
    <div class="seminarBlock">
        <div class="cards">
            <?php
                include("./db_con.php");
                $ownSeminarQuery = "SELECT seminars.*, COUNT(seminar_participants.seminar_id) as participants_count 
                            FROM seminars 
                            LEFT JOIN seminar_participants ON seminars.seminar_id = seminar_participants.seminar_id
                            GROUP BY seminars.seminar_id";
                $result = mysqli_query($con, $ownSeminarQuery);                        
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo "<div class='seminarCard'>";
                        echo "<h3>".htmlspecialchars($row['title'])."</h3>";
                        echo "<img src='./assets/".htmlspecialchars($row['banner'])."'alt='Seminar Banner'>";
                        echo "<p>".htmlspecialchars($row['description'])."</p>";
                        echo "<div class='info'><span>Date: ".htmlspecialchars($row['seminar_date'])."</span>";
                        echo "<span><i class='bx bxs-user-check'></i> ".htmlspecialchars($row['participants_count'])."</span></div>";
                        echo "<div class='btnclass'><a href='#?id=" . $row['seminar_id'] . "' id='button-30'>View</a>";
                        echo "</div>";
                        echo "</div>";
                    }
                }
                else{
                    echo "<p>You have not created any seminars yet.</p>";
                }
            ?>
        </div>
    </div>

        <?php include "./footer.php" ?>
        
        <script src="" async defer></script>
    </body>
</html>