<?php
  include("../../../BackEnd/db_con.php");
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
    <link rel="stylesheet" href="/FrontEnd/css/colors.css">
    <link rel="stylesheet" href="/FrontEnd/css/navbar.css">
    <link rel="stylesheet" href="/FrontEnd/css/organization.css">
    <link rel="stylesheet" href="/FrontEnd/css/footer.css">
    <link rel="stylesheet" href="/FrontEnd/css/notification.css">
    <link rel="stylesheet" href="/FrontEnd/css/feedback.css">
    <link rel="icon" href="/Icons&logos/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Organization</title>
</head>

<body>

    <?php include "../../components/navbarO.php" ?>

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
        <a href="organization.php" id="button-30">back</a>
        <form action="#" method="GET">
          <input type="text" name="query" placeholder="Search Organizations...">
          <button type="submit"><i class="ri-search-line"></i></button>
        </form>
      </div>
      <div class="organization-container">
        <?php 
              if (isset($_GET['query'])){
                include('../../../BackEnd/organization_search_BE.php');
              } else {
                include('../../../BackEnd/organization_fetch_BE.php');
              }
          ?>
      </div>
    </div>

    <?php include "../../components/footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst' ></i></button>

    <script src="/FrontEnd/js/scrollupBTN.js"></script>
    <script src="/FrontEnd/js/notification_color.js"></script>
    <script src="/FrontEnd/js/feedback.js"></script>
</body>
</html>