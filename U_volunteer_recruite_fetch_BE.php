<?php

    include("./db_con.php");
    $acc_id = $_SESSION['acc_id'];
    $sql1 = "SELECT user_id FROM user_list WHERE acc_id = $acc_id";
    $result1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $user_id = $row1['user_id'];

    $ownSeminarQuery = "SELECT 
                            r.service_type, 
                            r.remuneration, 
                            r.food_type, 
                            r.no_of_vol, 
                            r.recruite_id, 
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
                            r.isClosed != 1
                        GROUP BY 
                            r.recruite_id, r.service_type, r.remuneration, r.food_type, r.no_of_vol, s.title, s.seminar_date";

    $result = mysqli_query($con, $ownSeminarQuery);                        
    if(mysqli_num_rows($result) > 0){
        echo '<div class="cards" id="Recruitment_Posts">';
        while($row = mysqli_fetch_assoc($result)){
            echo "<div class='Vcard'>";
                echo "<div class='Vinfo-container'>";
                    echo "<h2>" . htmlspecialchars($row['title']) . "</h2>";
                    echo "<div class='img'>
                            <img src='./assets/" . $row['banner'] . "'>
                        </div>";
                    echo "<div class='row'>";
                        echo "<p>" . htmlspecialchars($row['seminar_date']) . "</p>";
                        echo "<p>" . htmlspecialchars($row['service_type']) . "</p>";
                        echo "<p>" . htmlspecialchars($row['remuneration']) . "</p>";
                    echo "</div>";
                    $checkRegistrationQuery = "SELECT * FROM vol_participants WHERE user_id = $user_id AND recruite_id = " . $row['recruite_id'];
                    $checkRegistrationResult = mysqli_query($con, $checkRegistrationQuery);
                    echo "<div class='row'>";
                        echo "<p>" . htmlspecialchars($row['food_type']) . "</p>";
                        echo "<p>" . htmlspecialchars($row['total_participants']) . " / " . htmlspecialchars($row['no_of_vol']) . "</p>";
                    echo "</div>";
                    echo "<div class='row'>";
                    if(mysqli_num_rows($checkRegistrationResult) > 0){
                        echo "<a class='register-btn' href='./U_volunteer_recruitment_cancel_BE.php?id=" . $row['recruite_id'] . "' onclick=\"return confirmAction('cancel')\">Cancel Registration</a>";
                    } else {
                        echo "<a class='register-btn' href='./U_volunteer_recruitment_accept_BE.php?id=" . $row['recruite_id'] . "&total_p=" . $row['no_of_vol'] . "' onclick=\"return confirmAction('register')\">Register</a>";
                    }
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    }
    else{
        echo "<p id='notFound'>No volunteer recruitments available.</p>";
    }