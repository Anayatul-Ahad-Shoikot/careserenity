<?php

    include_once "db_con.php";
    session_start();
    $searchTerm = mysqli_real_escape_string($con, $_POST['searchTerm']);
    $acc_id = $_SESSION['acc_id'];
    $sql1 = "SELECT user_id FROM user_list WHERE acc_id = $acc_id";
    $query1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_assoc($query1);
    $outgoing_id = $row1['user_id'];

    $output = "";

    if (!empty($searchTerm)) {
        $sql2 = "SELECT org_name, org_id, org_logo FROM org_list WHERE (org_name LIKE '%{$searchTerm}%' OR org_location LIKE '%{$searchTerm}%')";
        $query2 = mysqli_query($con, $sql2);
        if(mysqli_num_rows($query2) > 0){
            while($row2 = mysqli_fetch_assoc($query2)){
                $output .= '<a href="#" data-out_id="'. $outgoing_id .'" data-in_id="' . $row2['org_id'] . '">
                                <div class="content">
                                    <img src="/UserImage/accountPic/'. $row2['org_logo'] .'" alt="">
                                    <div class="details">
                                        <span>'. $row2['org_name'] .'</span>
                                    </div>
                                </div>
                            </a>';
            }
        }else{
            $output .= 'No organizations found !';
        }
    }
        echo $output;
?>