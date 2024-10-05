<?php
    include('./db_con.php');

    if(isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];
        $query = "DELETE FROM blog_post WHERE post_id = $post_id";
        mysqli_query($con, $query);
    }


    if(isset($_GET['seminar_id'])){
        $seminar_id = $_GET['seminar_id'];
        $query = "DELETE FROM seminars WHERE seminar_id = $seminar_id";
        mysqli_query($con, $query);
    }


    if(isset($_GET['fund_id'])){
        $fund_id = $_GET['fund_id'];
        $query = "DELETE FROM funds WHERE fund_id = $fund_id";
        mysqli_query($con, $query);
    }

    if(isset($_GET['recruite_id'])){
        $recruite_id = $_GET['recruite_id'];
        $query = "DELETE FROM volunteer_recruite WHERE recruite_id = $recruite_id";
        mysqli_query($con, $query);
    }
    
    header("Location: ./admin_dashboard.php");
    mysqli_close($con);