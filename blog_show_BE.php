<?php
include('./db_con.php');

$query = "SELECT w.post_id, w.acc_id, w.post_title, w.post_content, w.post_image, w.published, x.likes
    FROM blog_post AS w 
    LEFT JOIN blog_likes AS x ON x.post_id = w.post_id
    LEFT JOIN accounts AS y ON y.acc_id = w.acc_id";

$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="blog-post">';
        echo '<div class="blog-post_img"><img src="./assets/' . $row['post_image'] . '" alt="' . $row['post_title'] . '"></div>';
        echo '<div class="blog-post_info">';
        echo '<h1 class="blog-post_title">' . $row['post_title'] . '</h1>';
        echo '<div class="blog-post_date">';
        echo '<span>By ' . $row['acc_name'] . '</span>';
        echo '<span> ;' . $row['published'] . '</span>';
        echo '</div>';
        echo '<p class="blog-post_content">' . $row['post_content'] . '</p>';
        echo '<div class="info">';
        if ($_SESSION['role'] == 'user') {
            echo '<a href="./U_view_blog.php?post_id=' . $row['post_id'] . '" id="button-30">Read More</a>';
        } else {
            echo '<a href="./O_view_blog.php?post_id=' . $row['post_id'] . '" id="button-30">Read More</a>';
        }
        echo '<div class="likes">';
        echo '<i class="bx bxs-like"></i>';
        echo '<a class="like">&emsp;' . $row['likes'] . '</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p id="notFound">No blogs found.</p>';
}

mysqli_close($con);
