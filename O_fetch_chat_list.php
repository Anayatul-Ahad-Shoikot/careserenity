<?php
include "../../../BackEnd/db_con.php";

$data = json_decode(file_get_contents("php://input"), true);
$out_id = $data['out_id'];
$in_id = $data['in_id'];


$sql = "SELECT user_name AS name, user_image AS img FROM user_list WHERE user_id = '$in_id'";
        
$query = mysqli_query($con, $sql);
$user_data = mysqli_fetch_assoc($query);

if ($user_data) {
    $response = [
        'name' => $user_data['name'],
        'image' => $user_data['image']
    ];
    echo json_encode($response);
} else {
    // If no data found, return an error
    echo json_encode(['error' => 'No user data found']);
}
?>
