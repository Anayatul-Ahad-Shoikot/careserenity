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

        <!-- main body -->

        <?php
            $seminarQuery = "SELECT * FROM seminars WHERE org_id = (SELECT org_id FROM org_list WHERE acc_id = $acc_id)
                            OR org_id IN (SELECT org_id FROM other_orgs)";
            $result = mysqli_query($con, $seminarQuery);
        ?>

        <!-- Display All Seminars -->
        <div id="allSeminars">
            <h2>All Seminars</h2>
            <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='seminarCard'>";
                        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                        echo "<img src='" . htmlspecialchars($row['banner']) . "' alt='Seminar Banner'>";
                        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                        echo "<p>Date: " . htmlspecialchars($row['date']) . "</p>";
                        echo "<p>Type: " . htmlspecialchars($row['type']) . "</p>";

                        // Register Button
                        echo "<form method='POST' action='register_seminar.php'>";
                        echo "<input type='hidden' name='seminar_id' value='" . $row['seminar_id'] . "'>";
                        echo "<button type='submit'>Register</button>";
                        echo "</form>";

                        echo "</div>";
                    }
                } else {
                    echo "<p>No seminars available.</p>";
                }
            ?>
        </div>

        <!-- Search Seminars -->
        <div id="searchSeminars">
            <form method="GET" action="seminars.php">
                <input type="text" name="search" placeholder="Search seminars by title or description" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button type="submit">Search</button>
            </form>
        </div>

        <?php
            if (isset($_GET['search'])) {
                $searchTerm = mysqli_real_escape_string($con, $_GET['search']);
                $seminarQuery = "SELECT * FROM seminars 
                                WHERE (org_id = (SELECT org_id FROM org_list WHERE acc_id = $acc_id)
                                OR org_id IN (SELECT org_id FROM other_orgs))
                                AND (title LIKE '%$searchTerm%' OR description LIKE '%$searchTerm%')";
            }
        ?>

        <!-- Display Registered Seminars -->
         <?php
            // Fetch registered seminars for the user
            $registeredSeminarsQuery = "SELECT seminars.*, participants.participant_id 
                                        FROM seminars 
                                        JOIN participants ON seminars.seminar_id = participants.seminar_id 
                                        WHERE participants.user_id = $acc_id";
            $registeredResult = mysqli_query($con, $registeredSeminarsQuery);
        ?>
        <div id="registeredSeminars">
            <h2>Registered Seminars</h2>
            <?php
                if (mysqli_num_rows($registeredResult) > 0) {
                    while ($row = mysqli_fetch_assoc($registeredResult)) {
                        echo "<div class='seminarCard'>";
                        echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
                        echo "<img src='" . htmlspecialchars($row['banner']) . "' alt='Seminar Banner'>";
                        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                        echo "<p>Date: " . htmlspecialchars($row['seminar_date']) . "</p>";

                        // Cancel Button
                        echo "<form method='POST' action='cancel_registration.php'>";
                        echo "<input type='hidden' name='participant_id' value='" . $row['participant_id'] . "'>";
                        echo "<button type='submit'>Cancel Registration</button>";
                        echo "</form>";

                        echo "</div>";
                    }
                } else {
                    echo "<p>You haven't registered for any seminars yet.</p>";
                }
            ?>
        </div>

        <!-- main body end -->

        <?php include "./footer.php" ?>
        
        <script src="" async defer></script>
    </body>
</html>