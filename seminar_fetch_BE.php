<?php
    include("./db_con.php");
    $ownSeminarQuery = "SELECT seminars.*, COUNT(seminar_participants.seminar_id) as participants_count FROM seminars LEFT JOIN seminar_participants ON seminars.seminar_id = seminar_participants.seminar_id LEFT JOIN org_list ON org_list.org_id = seminars.org_id WHERE ( seminars.isRemoved = 0 AND seminars.isFinished = 0 AND seminars.visibility = 0 ) GROUP BY seminars.seminar_id";
    $result = mysqli_query($con, $ownSeminarQuery);                        
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class='seminarCard'>";
            echo "<img src='./assets/".htmlspecialchars($row['banner'])."'alt='Seminar Banner'>";
            echo "<h3>".htmlspecialchars($row['title'])."</h3>";
            echo "<p>".htmlspecialchars($row['description'])."</p>";
            echo "<div class='info'><span>Date: ".htmlspecialchars($row['seminar_date'])."</span>";
            echo "<span><i class='bx bxs-user-check'></i> ".htmlspecialchars($row['participants_count'])."</span></div>";
            echo "<div class='btnclass'><a href='./seminar_view.php?seminar_id=" . $row['seminar_id'] . "&org_id=" . $row['org_id'] . "' id='button-30'>View</a></div>";
            echo "</div>";
        }
    }
    else{
        echo "<p id='notFound'>You have not created any seminars yet.</p>";
    }