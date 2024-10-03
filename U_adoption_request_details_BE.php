<?php
include './db_con.php';
session_start();
$adoption_id = $_GET['adoption_id'];
$acc_id  = $_SESSION['acc_id'];

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
    $orphan_id = $row1['orphan_id'];
}

$query2 = "SELECT user_name FROM user_list WHERE acc_id = $acc_id";
$result2 = mysqli_query($con, $query2);
$row2 = mysqli_fetch_assoc($result2);
$user_name = $row2['user_name'];

$query3 = "SELECT orphan_image, first_name, last_name, org_id FROM orphan_list WHERE orphan_id = $orphan_id";
$result3 = mysqli_query($con, $query3);
$row3 = mysqli_fetch_assoc($result3);
$first_name = $row3['first_name'];
$last_name = $row3['last_name'];
$org_id = $row3['org_id'];
$orphan_image = $row3['orphan_image'];


$query4 = "SELECT org_name, org_email, org_phone FROM org_list WHERE org_id = $org_id";
$result4 = mysqli_query($con, $query4);
$row4 = mysqli_fetch_assoc($result4);
$org_name = $row4['org_name'];
$org_email = $row4['org_email'];
$org_phone = $row4['org_phone'];



