<?php
include('db_con.php');

if (isset($_GET['query'])) {
    session_start();
    $acc_id = $_SESSION['acc_id'];
    $query1 = "SELECT org_id FROM org_list WHERE acc_id = ?";
    $stmt1 = $con->prepare($query1);
    $stmt1->bind_param('i', $acc_id);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    $row1 = $result1->fetch_assoc();
    $org_id = $row1['org_id'];

    $search = $_GET['query'];
    if (!empty($search)) {
        $query = "SELECT * FROM orphan_list WHERE (first_name LIKE ? OR age LIKE ? OR gender = ? OR religion LIKE ? OR physical_condition LIKE ? OR education_level LIKE ? OR medical_history LIKE ?) AND org_id = ?";
        $stmt = $con->prepare($query);
        $searchTerm = "%$search%";
        $stmt->bind_param('sssssssi', $searchTerm, $searchTerm, $search, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $org_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['search_results'] = $result->fetch_all(MYSQLI_ASSOC);
            $_SESSION['positive'] = "Search matched";
        } else {
            $_SESSION['negative'] = "No orphan found";
        }
    } else {
        $_SESSION['negative'] = "Nothing to search with empty word!";
    }
} else {
    $_SESSION['negative'] = "Invalid request!";
}

header("Location: /FrontEnd/loggedIn/organizationpage/orphan.php");
exit();
?>
