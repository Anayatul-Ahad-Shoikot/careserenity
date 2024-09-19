<?php
    include('./db_con.php');
    session_start();

    if (isset($_GET['orphan_id'])) {
        $orphanId = mysqli_real_escape_string($con, $_GET['orphan_id']);
        $query = "UPDATE orphan_list SET removed_status = '0' WHERE orphan_id = '$orphanId'";
        $result = mysqli_query($con,$query);
        $_SESSION['positive'] = "Orphan replaced";
        header('Location: ./O_orphan_removed.php');
        exit(0);
    } else {
        $_SESSION['negative'] = "Orphan replace failed";
        header('Location: ./O_orphan_removed.php');
    }
    mysqli_close($con);

?>