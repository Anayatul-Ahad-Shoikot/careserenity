<?php
    include('./db_con.php');
    session_start();
    if (isset($_SESSION['acc_id']) && isset($_SESSION['role'])) {
        $acc_id = $_SESSION['acc_id'];
        $sql = "SELECT admin_priyority FROM admin_list WHERE acc_id = $acc_id";
        $row = mysqli_fetch_assoc(mysqli_query($con, $sql));
        $currennt_admin_priyority = $row['admin_priyority'];
        if (isset($_POST['delete'])) {
            $admin_id_to_remove = $_POST['acc_id'];
            if($currennt_admin_priyority == 1) {
            $sql_delete_accounts = "DELETE FROM accounts WHERE acc_id = $admin_id_to_remove";
            if (mysqli_query($con, $sql_delete_accounts)) {
                $_SESSION['success'] = "Admin removed successfully";
                header("Location: ./admin_profile.php");
                exit();
            } else {
                $_SESSION['error'] = "Unable to remove admin";
                header("Location: ./admin_profile.php");
            }
            } else {
                $_SESSION['error'] = "You don't have permission";
                header("Location: ./admin_profile.php");
            }
        }
    } else {
        echo "Login first";
    }
    mysqli_close($con);
?>