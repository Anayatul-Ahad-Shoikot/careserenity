<?php
include('./db_con.php');

if (isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];
    $query1 = "SELECT * FROM blog_post WHERE post_id = ?";
    $stmt1 = mysqli_prepare($con, $query1);
    mysqli_stmt_bind_param($stmt1, 'i', $post_id);
    mysqli_stmt_execute($stmt1);
    $result1 = mysqli_stmt_get_result($stmt1);
    if (mysqli_num_rows($result1) > 0) {
        $row = mysqli_fetch_assoc($result1);
        $author_acc_id = $row['acc_id'];
        $query2 = "SELECT acc_name FROM accounts WHERE acc_id = $author_acc_id";
        $result2 = mysqli_query($con, $query2);
        $row2 = mysqli_fetch_assoc($result2);
        $acc_name = $row2['acc_name'];
        $post_title = $row['post_title'];
        $post_content = $row['post_content'];
        $post_image = $row['post_image'];
        $published = $row['published'];
        $query3 = "SELECT likes FROM blog_likes WHERE post_id = $post_id";
        $result3 = mysqli_query($con, $query3);
        if (mysqli_num_rows($result3) > 0) {
            $row3 = mysqli_fetch_assoc($result3);
            $likes = $row3['likes'];
        }
    } else {
        echo 'Blog post not found.';
    }
}

?>