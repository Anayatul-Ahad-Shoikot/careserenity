<?php
    include('./db_con.php');
    $adoption_id = $_GET['adoption_id'];
    $query1 = "UPDATE adoptions SET org_delete = 1 WHERE adoption_id = $adoption_id";
    $result1 = mysqli_query($con, $query1);

    header("Location: ./O_adoption.php");
