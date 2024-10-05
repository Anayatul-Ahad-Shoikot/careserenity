<?php
    include("./db_con.php");
    $ownSeminarQuery = "SELECT seminars.*, COUNT(seminar_participants.seminar_id) as participants_count 
                            FROM seminars 
                            LEFT JOIN seminar_participants ON seminars.seminar_id = seminar_participants.seminar_id
                            WHERE org_id = (SELECT org_id FROM org_list WHERE acc_id = $acc_id)
                            GROUP BY seminars.seminar_id";
    $result = mysqli_query($con, $ownSeminarQuery);                        
    if(mysqli_num_rows($result) > 0){
        echo "<div class='cards'>";
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class='seminarCard'>";
            echo "<h3>".htmlspecialchars($row['title'])."</h3>";
            echo "<img src='./assets/".htmlspecialchars($row['banner'])."'alt='Seminar Banner'>";
            echo "<p>".htmlspecialchars($row['description'])."</p>";
            echo "<div class='info'><span>Date: ".htmlspecialchars($row['seminar_date'])."</span>";
            echo "<span><i class='bx bxs-user-check'></i> ".htmlspecialchars($row['participants_count'])."</span></div>";
            echo "<div class='btnclass'><a href='./O_seminar_edit.php?id=" . $row['seminar_id'] . "' id='button-30'>View</a>";
            echo "<a href='#' id='button-30' onclick='removeSeminar(" . $row['seminar_id'] . ")'>Delete</a>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    }
    else{
        echo "<p id='notFound'>You haven't created any seminar yet.</p>";
    }