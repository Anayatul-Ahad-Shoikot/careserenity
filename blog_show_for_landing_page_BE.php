<?php
include('./db_con.php');

$query = "SELECT w.post_id, w.acc_id, w.post_title, w.post_content, w.post_image, w.published, x.likes,
                CASE 
                    WHEN o.org_id IS NOT NULL THEN o.org_name
                    WHEN u.user_id IS NOT NULL THEN u.user_name
                    ELSE NULL
                END AS name
            FROM blog_post AS w 
            LEFT JOIN blog_likes AS x ON x.post_id = w.post_id
            LEFT JOIN accounts AS y ON y.acc_id = w.acc_id
            LEFT JOIN org_list AS o ON o.org_id = y.acc_id
            LEFT JOIN user_list AS u ON u.user_id = y.acc_id";

$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="card">
                <div class="card-img">
                    <img src="./assets/' . $row['post_image'] . '" alt="image">
                </div>
                <div class="blog-details">
                    <h1 class="blog-title">' . $row['post_title'] . '</h1>
                    <p class="user"></i>' . $row['name'] . '</p>
                    <p class="user">' . $row['published'] . '</p>
                    <a href="./default_view_blog.php?post_id=' . $row['post_id'] . '">Read</a>
                </div>
            </div>';
    }
} else {
    echo '<P id="nothing_found">No blog posts found.</p>';
}

mysqli_close($con);
