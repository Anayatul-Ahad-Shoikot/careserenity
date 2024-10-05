<?php
    include("./db_con.php");
    $ownSeminarQuery = "SELECT 
                            r.service_type, 
                            r.remuneration, 
                            r.food_type, 
                            r.no_of_vol, 
                            r.recruite_id,
                            r.seminar_id,
                            s.title, 
                            s.seminar_date,
                            s.banner,
                            COUNT(v.user_id) AS total_participants
                        FROM 
                            volunteer_recruite AS r
                        LEFT JOIN 
                            vol_participants AS v ON r.recruite_id = v.recruite_id
                        LEFT JOIN 
                            seminars AS s ON s.seminar_id = r.seminar_id
                        WHERE 
                            r.org_id =  $org_id
                        GROUP BY 
                            r.recruite_id, r.service_type, r.remuneration, r.food_type, r.no_of_vol, s.title, s.seminar_date";
    $result = mysqli_query($con, $ownSeminarQuery);                        
    if(mysqli_num_rows($result) > 0){
        echo '<div class="cards" id="Recruitment_Posts">';
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class='Vcard'>";
                echo "<a href='./O_seminar_edit.php?id=".htmlspecialchars($row['seminar_id'])."'><div class='Vinfo-container'>";
                echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
                echo "<div class='img'>
                    <img src='./assets/" . $row['banner'] . "'>
                </div>";
                echo "<div class='row'>";
                    echo "<p>" . htmlspecialchars($row['seminar_date']) . "</p>";
                    echo "<p>" . htmlspecialchars($row['service_type']) . "</p>";
                    echo "<p>" . htmlspecialchars($row['remuneration']) . "</p>";
                echo "</div>";
                echo "<div class='row'>";
                    echo "<p>" . htmlspecialchars($row['food_type']) . "</p>";
                    echo "<p>" . htmlspecialchars($row['total_participants']) . " / " . htmlspecialchars($row['no_of_vol']) . "</p>";
                echo "</div>";
                echo "</div></a>";
                echo "<a class='del-btn' onclick='confirmDelete(event, ".$row['recruite_id'].")'>×</a>";
            echo "</div>";
        }
        echo "</div>";
    }
    else{
        echo "<p id='notFound'>You have no recruitments currently.</p>";
    }