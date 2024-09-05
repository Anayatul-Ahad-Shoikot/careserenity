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
  <link rel="stylesheet" href="/FrontEnd/css/create_blog.css">
  <link rel="stylesheet" href="/FrontEnd/css/navbar.css">
  <link rel="stylesheet" href="/FrontEnd/css/footer.css">
  <link rel="stylesheet" href="/FrontEnd/css/notification.css">
  <link rel="icon" href="/Icons&logos/LOGO.png" type="image/x-icon">
  <title>CareSenerity | Blog</title>
</head>

<body>

  <?php include "../../components/navbarO.php" ?>

  <div class="container">
    <h1>Create a Blog Post</h1>
    <form action="../../../BackEnd/blog_upload_BE.php" method="POST" enctype="multipart/form-data">
      <input type="text" name="post_title" placeholder="Title" required>
      <textarea name="post_content" required placeholder="Type your thoughts here ..."></textarea>
      <div class="xxx">
        <select name="post_category">
          <option value="" selected disabled>Category</option>
          <option value="child-abuse">child-abuse</option>
          <option value="adoption">adoption</option>
          <option value="child-education">child-education</option>
          <option value="child-health">child-health</option>
          <option value="seminars">seminars</option>
          <option value="problems">problems</option>
          <option value="donation">donation</option>
        </select>
        <input class="img" type="file" name="img" accept="image/*">
      </div>
      <button type="submit" name="submit" id="button-30">Post</button>
    </form>
  </div>

  <?php include "../../components/footer.php" ?>

  <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst' ></i></button>

  <script src="/FrontEnd/js/scrollupBTN.js"></script>
  <script src="/FrontEnd/js/feedback.js"></script>
  <script src="/FrontEnd/js/notification_color.js"></script>
</body>

</html>