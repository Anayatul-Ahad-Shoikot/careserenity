<?php
    include("./db_con.php");
    $ownSeminarQuery = "SELECT v.*, s.title, s.seminar_date FROM volunteer_recruite AS v LEFT JOIN seminars AS s ON s.seminar_id = v.seminar_id WHERE v.org_id = $org_id ";
    $result = mysqli_query($con, $ownSeminarQuery);                        
    if(mysqli_num_rows($result) > 0){
        echo '<div class="cards" id="Recruitment_Posts">';
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class='card'>";
                echo "<a href='./O_seminar_edit.php?id=".htmlspecialchars($row['seminar_id'])."'><div class='info-container'>";
                    echo "<h2>".htmlspecialchars($row['title'])."</h2>";
                    echo "<p>Date : " . htmlspecialchars($row['seminar_date']) . "</p>";
                    echo "<p>Service Type : " . htmlspecialchars($row['service_type']) . "</p>";
                    echo "<p>Remuneration : " . htmlspecialchars($row['remuneration']) . "</p>";
                    echo "<p>Food : " . htmlspecialchars($row['food_type']) . "</p>";
                    echo "<p>Required : " . htmlspecialchars($row['no_of_vol']) . "</p>";
                echo "</div></a>";
                echo "<a class='del-btn' onclick='confirmDelete(event)'>×</a>";
            echo "</div>";
        }
        echo "</div>";
    }
    else{
        echo "<p id='notFound'>You have no recruitments currently.</p>";
    }