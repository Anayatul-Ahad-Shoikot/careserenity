<?php
include('./db_con.php');
session_start();

$adoption_id = $_GET['adoption_id'];
$user_name = $_GET['user_name'];
$first_name = $_GET['first_name'];

$query1 = "SELECT * FROM adoptions WHERE adoption_id = $adoption_id";
$result1 = mysqli_query($con, $query1);
if (mysqli_num_rows($result1) == 1) {
    $row1 = mysqli_fetch_assoc($result1);
    $request_date = $row1['request_date'];
    $status = $row1['status'];
    $email = $row1['email'];
    $phone = $row1['phone'];
    $occupation = $row1['occupation'];
    $income = $row1['income'];
    $maritalStatus = $row1['maritalStatus'];
    $reason = $row1['reason'];
    $children = $row1['children'];
    $livingEnvironment = $row1['livingEnvironment'];
    $expectations = $row1['expectations'];
    $additionalInfo = $row1['additionalInfo'];
}

$query2 = "SELECT user_image FROM user_list WHERE user_name = '$user_name'";
$result2 = mysqli_query($con, $query2);
$row2 = mysqli_fetch_assoc($result2);
$aplicant_image = $row2['user_image'];

$query3 = "SELECT orphan_image FROM orphan_list WHERE first_name = '$first_name'";
$result3 = mysqli_query($con, $query3);
$row3 = mysqli_fetch_assoc($result3);
$orphan_image = $row3['orphan_image'];
