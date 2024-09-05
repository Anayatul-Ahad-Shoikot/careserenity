<?php
  include('./blog_fetch_BE.php');
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
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
  <link rel="stylesheet" href="./css/colors.css">
  <link rel="stylesheet" href="./css/view_blog.css">
  <link rel="stylesheet" href="./css/navbar.css">
  <link rel="stylesheet" href="./css/footer.css">
  <link rel="stylesheet" href="./css/notification.css">
  <link rel="icon" href="./assets/LOGO.png" type="image/x-icon">
  <title>CareSenerity | Blog</title>
</head>

<body>

  <?php include "./navbarU.php" ?>


  <div class="container">
    <div class="options">
      <a href="./U_home.php" id="button-30">Go back</a>
    </div>
    <div class="blog-details-container">
      <div class="IMG">
        <img src="./assets/<?php echo $post_image ?>" alt="image name here">
      </div>

      <div class="blog-details">
        <h1 class="blog-details-title"><?php echo $post_title ?></h1>
        <h3 class="blog-details-author">By <a href="./U_see_user_profile.php?acc_id=<?php echo $author_acc_id ?>"><?php echo $acc_name . "</a>, " . $published ?></h3>
        <p class="blog-details-content">
          <?php echo $post_content ?>
        </p>
      </div>

      <div class="blog-actions">
        <form action="./react_handler_BE.php" method="post">
          <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
          <button type="submit" name="like" onclick="storeScrollPosition('LIKE')" id="button-30"><i class='bx bxs-like'></i></button>
        </form>
        <p class="likes-count"><?php echo $likes ?></p>
      </div>

      <h2><i class='bx bxs-message-dots'></i> Comments:</h2>

      <div class="comments">
        <?php include('./comment_fetch_BE.php'); ?>
      </div>

      <form id="write-comment" action="./comment_handler_BE.php" method="post">
        <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
        <input type="text" name="comment" placeholder="Add a comment" required>
        <button type="submit" name="submit" onclick="storeScrollPosition('COMMENT')" id="button-30">Comment</button>
      </form>
    </div>
  </div>

  <?php include "./footer.php" ?>

  <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst'></i></button>

  <script src="./js/scrollupBTN.js"></script>
  <script src="./js/react.js"></script>
  <script src="./js/notification_color.js"></script>
</body>

</html>