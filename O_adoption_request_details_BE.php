<?php
include('./db_con.php');
session_start();

$adoption_id = $_GET['adoption_id'];
$user_id = $_GET['user_id'];
$orphan_id = $_GET['orphan_id'];

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

$query2 = "SELECT user_name FROM user_list WHERE user_id = $user_id";
$result2 = mysqli_query($con, $query2);
$row2 = mysqli_fetch_assoc($result2);
$user_name = $row2['user_name'];

$query3 = "SELECT first_name, last_name FROM orphan_list WHERE orphan_id = $orphan_id";
$result3 = mysqli_query($con, $query3);
$row3 = mysqli_fetch_assoc($result3);
$first_name = $row3['first_name'];
$last_name = $row3['last_name'];

