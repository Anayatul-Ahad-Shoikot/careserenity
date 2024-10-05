<?php
include("./see_organization_profile_BE.php");
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
    <link rel="stylesheet" href="./css/see_organization_profile.css">
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/feedback.css">
    <link rel="stylesheet" href="./css/cards.css">
    <link rel="stylesheet" href="./css/volunteer.css">
    <link rel="icon" href="./assets/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Organization</title>
</head>

<body>

    <?php include "./navbarO.php" ?>

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
                <img src="./assets/<?php echo $org_logo ?>" alt="profile" width="250px" height="250px">
            </div>
            <div class="account-data">
                    <h1><?php echo $org_name ?></h1>
                    <p>Location : <?php echo $org_location ?></p>
                    <p>Email : <?php echo $org_email ?></p>
                    <p>Contact : <?php echo $org_phone ?></p>
                    <p>Established : <?php echo $established ?>, Joined : <?php echo $acc_join_date ?></p>
                    <p>Account Type : <?php echo $role ?></p>
            </div>
            <div class="biography">
                <h1><?php echo $org_vision ?></h1>
                <p><?php echo $org_description ?></p>
            </div>
        </div>

        <div class="options">
            <a href="./O_organization.php" id="button-30">back</a>
            <a href="#?out_id=<?php echo $org_id ?>&in_id=<?php echo $org_id ?>" id="button-30">Inbox</a>
            <a href="./O_see_organization_orphanage.php?org_id=<?php echo $org_id ?>" id="button-30" >Orphanage</a>
        </div>

        <div class="short-reports">

        <h1 id="heading">Funds :</h1>
            <div class="ag-format-container">
                <?php
                include("./db_con.php");
                $acc_id = $_SESSION['acc_id'];
                $id = $_GET['org_id'];
                $sql = "SELECT 
                            funds.fund_id, 
                            funds.name, 
                            funds.amount, 
                            funds.received, 
                            org_list.org_name, 
                            funds.img 
                        FROM 
                            funds 
                        LEFT JOIN 
                            org_list ON funds.org_id = org_list.org_id 
                        WHERE 
                            funds.completed = ? AND funds.org_id = $id";

                $value = 0;
                $stmt = $con->prepare($sql);
                $stmt->bind_param('i', $value);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    echo "<div class='funds'>";
                    while ($fund = $result->fetch_assoc()) {
                        echo '<div class="card">';
                        echo '<img src="./assets/' . htmlspecialchars($fund['img']) . '" alt="">';
                        echo '<h1>' . htmlspecialchars($fund['name']) . '</h1>';
                        echo '<p>' . htmlspecialchars($fund['org_name']) . '</p>';
                        echo '<p class="price">' . htmlspecialchars($fund['received']) . '/' . htmlspecialchars($fund['amount']) . '</p>';
                        echo '<a href="./fund_donate_loggedin.php?fund_id=' . htmlspecialchars($fund['fund_id']) . '" id="button-30">Donate</a>';
                        echo '</div>';
                    }
                    echo '</div>';
                } else {
                    echo '<p id="notFound">Currently no funds are available.</p>';
                }

                $stmt->close();
                $con->close();
                ?>
            </div>







            <h1 id="heading">Volunteers Recruitment:</h1>
            <div class="ag-format-container">
                <div class="ag-courses_box">
                <?php
                    include("./db_con.php");
                    $acc_id = $_SESSION['acc_id'];
                    $id = $_GET['org_id'];

                    $ownSeminarQuery = "SELECT 
                                            r.service_type, 
                                            r.remuneration, 
                                            r.food_type, 
                                            r.no_of_vol, 
                                            r.recruite_id, 
                                            s.title, 
                                            s.seminar_date,
                                            s.banner,
                                            COUNT(v.user_id) AS total_participants
                                        FROM 
                                            volunteer_recruite AS r
                                        LEFT JOIN 
                                            vol_participants AS v ON r.recruite_id = v.recruite_id
                                        LEFT JOIN 
                                            seminars AS s ON s.seminar_id = r.seminar_id
                                        WHERE 
                                            r.isClosed != 1 AND s.org_id = $id
                                        GROUP BY 
                                            r.recruite_id, r.service_type, r.remuneration, r.food_type, r.no_of_vol, s.title, s.seminar_date";

                    $result = mysqli_query($con, $ownSeminarQuery);                        
                    if(mysqli_num_rows($result) > 0){
                        echo '<div class="cards" id="Recruitment_Posts">';
                        while($row = mysqli_fetch_assoc($result)){
                            echo "<div class='Vcard'>";
                                echo "<div class='Vinfo-container'>";
                                    echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
                                    echo "<div class='img'>
                                            <img src='./assets/" . $row['banner'] . "'>
                                        </div>";
                                    echo "<div class='row'>";
                                        echo "<p>" . htmlspecialchars($row['seminar_date']) . "</p>";
                                        echo "<p>" . htmlspecialchars($row['service_type']) . "</p>";
                                        echo "<p>" . htmlspecialchars($row['remuneration']) . "</p>";
                                    echo "</div>";
                                    echo "<div class='row'>";
                                        echo "<p>" . htmlspecialchars($row['food_type']) . "</p>";
                                        echo "<p>" . htmlspecialchars($row['total_participants']) . " / " . htmlspecialchars($row['no_of_vol']) . "</p>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        }
                        echo "</div>";
                    }
                    else{
                        echo "<p id='notFound'>No volunteer recruitments available.</p>";
                    }
                    ?>
                </div>
            </div>

            <h1 id="heading">Seminars :</h1>
            <div class="ag-format-container">
                <div class="card_boxes">
                <?php
                    include("./db_con.php");
                    $id = $_GET['org_id'];
                    $query = "SELECT * FROM seminars WHERE isRemoved = 0 AND visibility = 0 AND org_id = $id";
                    $result = mysqli_query($con, $query);
                    
                    if (mysqli_num_rows($result) > 0) {
                        while ($row1 = mysqli_fetch_assoc($result)) {
                            echo '<a href="/seminar_view.php?seminar_id='. $row1['seminar_id'] .'&org_id='. $row1['org_id'] .'" style="text-decoration: none;">
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
                                    </div>
                                </a>';
                        }
                    } else {
                        echo "<p id='notFound'>No seminars found!</p>";
                    }
                    
                    mysqli_close($con);
                ?>
                </div>
            </div>
        </div>


    </div>


    <?php include "./footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst' ></i></button>

    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>
</body>

</html>
