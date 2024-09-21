<?php
include('./db_con.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $acc_id = $_SESSION['acc_id'];
    $role = $_SESSION['role'];
    $post_id = mysqli_real_escape_string($con, $_POST['post_id']);
    $comment_content = mysqli_real_escape_string($con, $_POST['comment']);
    $sql = "SELECT 
                CASE 
                    WHEN '$role' = 'org' THEN o.org_name
                    WHEN '$role' = 'user' THEN u.user_name
                    ELSE NULL
                END AS acc_name
            FROM 
                accounts AS a
            LEFT JOIN 
                org_list AS o ON a.acc_id = o.acc_id AND '$role' = 'org'
            LEFT JOIN 
                user_list AS u ON a.acc_id = u.acc_id AND '$role' = 'user'
            WHERE 
                a.acc_id = $acc_id";
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
