<?php
    include("./O_profile_fetch_BE.php");
    $acc_id = $_SESSION['acc_id'];
    $query5 = "SELECT org_id FROM org_list WHERE acc_id = $acc_id";
    $result5 = mysqli_query($con, $query5);
    $row5 = mysqli_fetch_assoc($result5);
    $org_id = $row5['org_id'];
    $fetchUnreadNotificationsQuery = "SELECT COUNT(*) as unread_count FROM notifications WHERE is_read = 0 AND org_id = (SELECT org_id FROM org_list WHERE acc_id = $acc_id)";
    $unreadNotificationsResult = mysqli_query($con, $fetchUnreadNotificationsQuery);
    $unreadCount = 0;
    if ($unreadNotificationsResult) {
        $unreadRow = mysqli_fetch_assoc($unreadNotificationsResult);
        $unreadCount = $unreadRow['unread_count'];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel="stylesheet" href="./css/colors.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/profile_edit.css">
    <link rel="stylesheet" href="./css/seminar.css">
    <link rel="stylesheet" href="./css/volunteer.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/feedback.css">
    <link rel="icon" href="./assets/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Volunteer </title>
</head>

<body>

    <?php include "./navbarO.php" ?>

    <div class="feedback">
        <?php
        if (isset($_SESSION['positive'])) {
            echo '<div class="positive">
                        <h5>' . $_SESSION['positive'] . '</h5>
                    </div>';
            unset($_SESSION['positive']);
        }
        if (isset($_SESSION['negative'])) {
            echo '<div class="negative">
                        <h5>' . $_SESSION['negative'] . '</h5>
                    </div>';
            unset($_SESSION['negative']);
        }
        ?>
    </div>

    <div class="options">
        <button onclick="showForm(this)" id="button-30">Volunteer +</button>
    </div>

    <div class="container" id="volForm" style="display: none;">
        <div class="img" style="background-image:url('./assets/bg_volunteer.png')">
            <div class="overlay"></div>
        </div>
        <form action="./O_recruite_volunteer_BE.php" method="POST" enctype="multipart/form-data" >
            <h2>Volunteer Form</h2>
            <div class="form_row">
                <label for="seminar">Choose Seminar :</label>
                <select name="seminar" id="seminar">
                    <?php
                    include './db_con.php';
                    $query = "SELECT seminar_id, title FROM seminars WHERE org_id = $org_id";
                    $result = mysqli_query($con, $query);
                    if (mysqli_num_rows($result) > 0) {
                            echo "<option value='' selected disabled>Select seminar</option>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='{$row['seminar_id']}'>{$row['title']}</option>";
                        }
                    } else {
                        echo "<option value=''>No seminars available</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form_row">
                <label for="No_of_vol">Number of Volunteers :</label>
                <input type="number" id="No_of_vol" name="No_of_vol" required>
            </div>
            <div class="form_row">
                <label for="service_type">Service Type :</label>
                <select name="service_type" id="service_type" onchange="toggleRemuneration()">
                    <option value='' selected disabled>Select service type</option>
                    <option value="Paid">Paid</option>
                    <option value="Free Service">Free Service</option>
                </select>
            </div>
            <div class="form_row" id="remuneration_row">
                <label for="remuneration">Remuneration :</label>
                <input type="number" id="remuneration" name="remuneration" required>
            </div>
            <div class="form_row">
                <label for="food">Food Type :</label>
                <select name="food" id="food">
                    <option value='' selected disabled>Select food type</option>
                    <option value="WithFood">With Food</option>
                    <option value="WithoutFood">Without Food</option>
                </select>
            </div>
            <input type="hidden" name="org_id" value="<?php echo $org_id ?>">
            <div class="buttons">
                <button id="button-30">Create</button>
            </div>
        </form>
    </div>


    <h1 id="heading">Recruitment Posts :</h1>
    <div class="seminarBlock">
        <?php include('./O_recruite_vol_fetch_BE.php') ?>
    </div>



    <?php include "./footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst' ></i></button>

    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>
    <script>
        function showForm(button) {
            const form = document.getElementById('volForm');
            if(form.style.display == 'block'){
                form.style.display = 'none';
                button.innerHTML = "Volunteer +";
            } else {
                form.style.display = 'block';
                button.innerHTML = "Cancel";
            }
        }

        function toggleRemuneration() {
            const serviceType = document.getElementById('service_type').value;
            const remunerationRow = document.getElementById('remuneration_row');
            
            if (serviceType === 'Paid') {
                remunerationRow.style.display = 'flex';
                document.getElementById('remuneration').setAttribute('required', 'required');
            } else {
                remunerationRow.style.display = 'none';
                document.getElementById('remuneration').removeAttribute('required');
            }
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            toggleRemuneration();
        });

        function confirmDelete(event, recruitmentId) {
            event.stopPropagation();
            const confirmation = confirm("Do you want to close this recruitment?");
            if (confirmation) {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "./O_volunteer_recruitment_delete_BE.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        alert("Recruitment deleted successfully.");
                    } else if (xhr.readyState === 4) {
                        alert("An error occurred while deleting the recruitment.");
                    }
                };
                xhr.send("id=" + recruitmentId);
            }
        }
    </script>
</body>

</html>