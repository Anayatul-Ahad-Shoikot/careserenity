<?php
    
include_once "db_con.php";
session_start();
$searchTerm = mysqli_real_escape_string($con, $_POST['searchTerm']);
$acc_id = $_SESSION['acc_id'];
$sql1 = "SELECT org_id FROM org_list WHERE acc_id = $acc_id";
$query1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($query1);
$outgoing_id = $row1['org_id'];

$output = "";

if (!empty($searchTerm)) {
    $sql2 = "SELECT user_name, user_id, user_image FROM user_list WHERE (user_name LIKE '%{$searchTerm}%' OR user_location LIKE '%{$searchTerm}%')";
    $query2 = mysqli_query($con, $sql2);
    if (mysqli_num_rows($query2) > 0) {
        while ($row2 = mysqli_fetch_assoc($query2)) {
            $output .= '<a href="#" data-out_id="'. $outgoing_id .'" data-in_id="' . $row2['user_id'] . '">
                            <div class="content">
                                <img src="/UserImage/accountPic/'. $row2['user_image'] .'" alt="">
                                <div class="details">
                                    <span>'. $row2['user_name'] .'</span>
                                </div>
                            </div>
                        </a>';
        }
    } else {
        $output .= 'No users found!';
    }
}

echo $output;

?>
