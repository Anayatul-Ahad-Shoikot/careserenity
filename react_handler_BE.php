<?php
include('./db_con.php');
session_start();

if (isset($_POST['like']) && isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    $role = $_SESSION['role'];
    $viewer_acc_id = $_SESSION['acc_id'];
    $unlikeQuery = "";
    $likeQuery = "";
    $checkQuery = "SELECT * FROM like_handle WHERE post_id = $post_id AND viewer_acc_id = $viewer_acc_id";
    $checkResult = mysqli_query($con, $checkQuery);
    if (mysqli_num_rows($checkResult) > 0) {
        $remove = "DELETE FROM like_handle WHERE post_id = $post_id AND viewer_acc_id = '$viewer_acc_id'";
        mysqli_query($con, $remove);
        $reduceLike = "UPDATE blog_likes SET likes = (likes - 1) WHERE post_id = $post_id";
        mysqli_query($con, $reduceLike);
        if ($_SESSION['role'] == 'user') {
            header("Location: ./U_view_blog.php?post_id=$post_id");
            exit(0);
        } else {
            header("Location: ./O_view_blog.php?post_id=$post_id");
            exit(0);
        }
    } 
}
    
//    else {
//         $add = "INSERT INTO like_handle (post_id, viewer_acc_id) VALUES ($post_id, $viewer_acc_id)";
//         mysqli_query($con, $add);
//         $increaseLike = "UPDATE blog_likes SET likes = (likes + 1) WHERE post_id = $post_id";
//         mysqli_query($con, $increaseLike);
//         if ($_SESSION['role'] == 'user') {
//             header("Location: ./U_view_blog.php?post_id=$post_id");
//             exit(0);
//         } else {
//             header("Location: ./O_view_blog.php?post_id=$post_id");
//             exit(0);
//         }
//     }
// } else {
//     echo 'Invalid request.';
// }
// mysqli_close($con);
