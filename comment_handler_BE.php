<?php
include('./db_con.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acc_id = $_SESSION['acc_id'];
    $role = $_SESSION['role'];
    $post_id = mysqli_real_escape_string($con, $_POST['post_id']);
    $comment_content = mysqli_real_escape_string($con, $_POST['comment']);
    $sql = "SELECT acc_name FROM accounts WHERE acc_id = $acc_id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $acc_name = $row['acc_name'];
    $date = date("Y-m-d");
    $insertCommentQuery = "INSERT INTO blog_comment (post_id, viewer_acc_name, comment, comment_date) VALUES ($post_id, '$acc_name', '$comment_content', '$date')";
    if (mysqli_query($con, $insertCommentQuery)) {
        if ($role == 'org') {
            header("Location: ./O_view_blog.php?post_id=$post_id");
            exit();
        } elseif ($role == 'user') {
            header("Location: ./U_view_blog.php?post_id=$post_id");
            exit();
        }
    } else {
        $_SESSION['negative'] = "Comment failed.";
        echo "Error: " . mysqli_error($con);
    }
} else {
    $_SESSION['negative'] = "Error occured.";
    echo "Invalid request method.";
}
mysqli_close($con);
