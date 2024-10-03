<?php
    include("./db_con.php");
    $ownSeminarQuery = "SELECT v.*, s. FROM volunteer_recruite AS v LEFT JOIN seminars AS s ON s.org_id = v.org_id WHERE org_id = $org_id ";
    $result = mysqli_query($con, $ownSeminarQuery);                        
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class='seminarCard'>";
            echo "<img src='./assets/volunteer.jpg";
            echo "<h3>".htmlspecialchars($row['recruite_title'])."</h3>";
            echo "<p>".htmlspecialchars($row['description'])."</p>";
            echo "<div class='info'><span>Date: ".htmlspecialchars($row['seminar_date'])."</span>";
            echo "<span><i class='bx bxs-user-check'></i> ".htmlspecialchars($row['participants_count'])."</span></div>";
            echo "<div class='btnclass'><a href='./seminar_view.php?seminar_id=" . $row['seminar_id'] . "&org_id=" . $row['org_id'] . "' id='button-30'>View</a></div>";
            echo "</div>";
        }
    }
    else{
        echo "<p>You have not created any seminars yet.</p>";
    }