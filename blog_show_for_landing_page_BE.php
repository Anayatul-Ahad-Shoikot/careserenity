<?php
include('./db_con.php');

$query = "SELECT w.post_id, w.acc_id, w.post_title, w.post_content, w.post_image, w.published, x.likes, y.acc_name
    FROM blog_post AS w 
    LEFT JOIN blog_likes AS x ON x.post_id = w.post_id
    LEFT JOIN accounts AS y ON y.acc_id = w.acc_id";

$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="blog-card">';
        echo '<img src="./assets/' . $row['post_image'] . '" alt="image">';
        echo '<div class="blog-details">';
        echo '<h1 class="blog-title">' . $row['post_title'] . '</h1>';
        echo '<p class="user"></i>' . $row['acc_name'] . '</p>';
        echo '<p class="date">' . $row['published'] . '</p>';
        echo '<a href="./default_view_blog.php?post_id=' . $row['post_id'] . '">Read</a>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'No blog posts found.';
}

mysqli_close($con);
