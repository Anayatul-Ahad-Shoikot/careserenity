<?php
    include('./db_con.php');
    session_start();
    $acc_id = $_SESSION['acc_id'];
    $query1 = "SELECT org_id FROM org_list WHERE acc_id = ?";
    $stmt1 = $con->prepare($query1);
    $stmt1->bind_param('i', $acc_id);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    $row1 = $result1->fetch_assoc();
    $org_id = $row1['org_id'];

        if (isset($_GET['query']) || isset($_GET['gender']) || isset($_GET['adoption_status'])) {
            $query = isset($_GET['query']) ? $_GET['query'] : '';
            $gender = isset($_GET['gender']) ? $_GET['gender'] : '';
            $adoption_status = isset($_GET['adoption_status']) ? $_GET['adoption_status'] : '';
            $sql = "SELECT * FROM orphan_list WHERE removed_status = 0 AND org_id = ?";
            $conditions = [];
            $params = [];
            if (!empty($query)) {
                $conditions[] = "(first_name LIKE ? OR last_name LIKE ? OR religion LIKE ? OR age LIKE ?)";
                $search_query = "%" . $query . "%";
                array_push($params, $search_query, $search_query, $search_query, $search_query);
            }
            if (!empty($gender)) {
                $conditions[] = "gender = ?";
                array_push($params, $gender);
            }
            if ($adoption_status !== '') {
                $conditions[] = "adoption_status = ?";
                array_push($params, $adoption_status);
            }
            if (!empty($conditions)) {
                $sql .= " AND " . implode(" AND ", $conditions);
            }
            $stmt = $con->prepare($sql);

            if (!empty($params)) {
                array_unshift($params, $org_id);
                $types = str_repeat('s', count($params));
                $stmt->bind_param($types, ...$params);
            }
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $_SESSION['search_results'] = $result->fetch_all(MYSQLI_ASSOC);
                $_SESSION['positive'] = "Search matched!";
            } else {
                $_SESSION['search_results'] = "<P id='notFound'>No result found !</P>";
                $_SESSION['negative'] = "No matched result found!";
            }
        } else {
            $_SESSION['negative'] = "Nothing to search with empty word!";
        }
    header("Location: ./O_orphan.php");
    exit();
?>
