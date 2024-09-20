<?php 
    include('./db_con.php');
    session_start();
    $acc_id = $_SESSION['acc_id'];
    $adoption_id = $_GET['adoption_id'];
    $orphan_id = $_GET['orphan_id'];
    $user_id = $_GET['user_id'];
    $current_date = date('d-m-y');
    $query1 = "SELECT first_name, last_name FROM orphan_list WHERE orphan_id = $orphan_id";
    $result1 = mysqli_query($con,$query1);
    if(mysqli_num_rows($result1) == 1){
        $row1 = mysqli_fetch_assoc($result1);
        $firstName = $row1['first_name'];
        $lastName = $row1['last_name'];
    }
    $query2 = "UPDATE adoptions AS ad SET ad.status = 1, ad.issued_date = '$current_date' WHERE ad.adoption_id = $adoption_id AND ad.status != 1";
        if(mysqli_query($con, $query2)) {

            $sql = "SELECT o.org_id FROM accounts AS a LEFT JOIN org_list AS o ON a.acc_id = o.acc_id Where a.acc_id = $acc_id";

            $sql_result = mysqli_query($con, $sql);
            if (mysqli_num_rows($sql_result) == 1) {
                $row = mysqli_fetch_array($sql_result);
                $org_id = $row['org_id'];
            }

            $query3 = "UPDATE notifications SET is_read = 0, content = 'Adoption request approved for $firstName $lastName' WHERE (user_id = $user_id AND orphan_id = $orphan_id AND org_id = $org_id)";
            $query4 = "UPDATE orphan_list SET adoption_status = '1' WHERE orphan_id = $orphan_id";
            if((mysqli_query($con, $query3)) && (mysqli_query($con, $query4))){
                $_SESSION['positive'] = "Request approved";
                header("Location: ./O_profile.php");
            } else {
                $_SESSION['negative'] = "Error occured, query failed";
                header("Location: ./O_profile.php");
            }
        } else {
            $_SESSION['negative'] = "Already approved";
            header("Location: ./O_profile.php");
        }
