<?php
    include('db_con.php');
    session_start();

    if (isset($_GET['orphan_id'])) {
        $orphanId = mysqli_real_escape_string($con, $_GET['orphan_id']);
        $query = "UPDATE orphan_list SET removed_status = '1' WHERE orphan_id = '$orphanId'";
        $result = mysqli_query($con,$query);
        $_SESSION['positive'] = "Orphan removed successfuly";
        header('Location: /FrontEnd/loggedIn/organizationpage/orphan.php');
        exit(0);
    } else {
        $_SESSION['negative'] = "Orphan remove failed";
        header('Location: /FrontEnd/loggedIn/organizationpage/orphan.php');
        exit(0);
    }
    mysqli_close($con);
?>