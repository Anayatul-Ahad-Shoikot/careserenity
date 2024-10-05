<?php
    include("./O_profile_fetch_BE.php");
    include('./O_seminar_data_fetch_BE.php');
    include("./O_seminar_edit_BE.php");

    $acc_id = $_SESSION['acc_id'];
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
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="./css/fund.css">
    <link rel="stylesheet" href="./css/adoption.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/feedback.css">
    <link rel="icon" href="./assets/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Seminar </title>
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


    <div class="container">

        <div class="accounnt-information-container">
            <div class="account-picture">
                <img src="./assets/<?php echo $org_logo ?>" alt="profile" width="250px" height="250px">
            </div>
            <div class="account-data">
                <h1><?php echo $org_name ?></h1>
                <p>Location : <?php echo $org_location ?>, Bangladesh</p>
                <p>Email : <?php echo $org_email ?></p>
                <p>Contact : <?php echo $org_phone ?></p>
                <p>Established : <?php echo $established ?>, Joined : <?php echo $acc_join_date ?></p>
                <p>Account Type : <?php echo $role ?></p>
            </div>
            <div class="biography">
                <h1><?php echo $org_vision ?></h1>
                <p><?php echo $org_description ?></p>
            </div>
        </div>

        <div class="options">
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="search..." />
                    <button class="search-btn">
                        <i class="fas fa-search search-icon"></i>
                    </button>
                </div>
            </form>
            <a href="./O_seminar_edit.php?id=<?php echo $seminar_id ?>" id="button-30"><i class='bx bx-refresh' style="color:black"></i></a>
            <a href="./O_seminar.php" id="button-30">Back</a>
        </div>

        <div class="FundList">
            <h1>Seminar Details :</h1>
            <div style="display:flex; align-items:center;justify-content:space-between;">
            <form action="" method="POST" enctype="multipart/form-data" style="width: 50%;">
                <div class="form_row">
                    <label for="title">Seminar Title:</label>
                    <input type="text" id="title" name="title" placeholder="<?php echo $title ?>">
                </div>
                <div class="form_row">
                    <label for="description">Seminar Description:</label>
                    <input type="text" name="description" id="description" placeholder="<?php echo $description ?>" >
                </div>
                <div class="form_row">
                    <label for="subject">Seminar Topic:</label>
                    <input type="text" id="subject" name="subject" placeholder="<?php echo $subject ?>">
                </div>
                <div class="form_row">
                    <label for="guest">Guests:</label>
                    <input type="text" id="guest" name="guest" placeholder="<?php echo $guest ?>">
                </div>
                <div class="form_row">
                    <label for="type">Type:</label>
                    <select name="type" id="type">
                        <option disabled><?php echo $type ?></option>
                        <option value="online">Online</option>
                        <option value="offline">Offline</option>
                    </select>
                </div>
                <div class="form_row">
                    <div id="locationField" style="display: none;">
                        <label for="location">Location:</label>
                        <input type="text" id="location" name="location" placeholder="<?php echo $location ?>">
                    </div>
                </div>
                <div class="form_row">
                    <label for="seminar_date">Date:</label>
                    <input type="date" id="seminar_date" name="seminar_date" value="<?php echo $seminar_date ?>">
                </div>
                <div class="form_row">
                    <label for="seminar_date">Status : </label>
                    <input type="text" placeholder="<?php echo $visibility == 1 ? 'Hidden' : 'Public'; ?>" disabled>
                </div>
                <div class="form_row">
                        <label for="img">Banner :</label>
                        <input type="file" name="img">
                </div>
                <input type="hidden" name="seminar_id" value="<?php echo $seminar_id ?>">
                <button id="button-30" name="update">Update</button>
                <button id="button-30" name="hide">Hide</button>
                <button id="button-30" name="Public">Public</button>
            </form>
            <div style="Display: flex; flex-direction:column; gap:30px">
                <p style="background-color:lightgoldenrodyellow;padding:8px; font-weight:500">Total participants : <?php echo $total_participants ?></p>
                <img src="./assets/<?php echo $banner ?>" style="width:450px; height:250px; border-radius:15px;">
            </div>
            
            </div>
        </div>


        <section class="table__body">
            <h1>Participant List :</h1>
            <table>
                <thead>
                    <tr>
                        <th> Name </th>
                        <th> Email </th>
                        <th> Contact </th>
                        <th> Date </th>
                    </tr>
                </thead>
                <tbody>
                    <?php include ('./O_seminar_participant_fetch_BE.php') ?>
                </tbody>
            </table>
        </section>

        <br>
        <section class="table__body">
            <h1>Volunteer List :</h1>
            <table>
                <thead>
                    <tr>
                        <th> Name </th>
                        <th> Contact </th>
                        <th> Gender </th>
                        <th> Address </th>
                    </tr>
                </thead>
                <tbody>
                    <?php include ('./O_seminar_volunteer_fetch_BE.php') ?>
                </tbody>
            </table>
        </section>
    </div>

    <?php include "./footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst' ></i></button>

    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>
    <script src="./js/seminar_options.js"></script>

    <script>
        const search = document.querySelector(".options .form-input input"),
        table_rows = document.querySelectorAll("tbody tr"),
        table_headings = document.querySelectorAll("thead th");

        search.addEventListener("input", searchTable);
        function searchTable() {
        table_rows.forEach((row, i) => {
            let table_data = row.textContent.toLowerCase(),
            search_data = search.value.toLowerCase();
            row.classList.toggle("hide", table_data.indexOf(search_data) < 0);
            row.style.setProperty("--delay", i / 25 + "s");
        });
        document.querySelectorAll("tbody tr:not(.hide)").forEach((visible_row, i) => {
            visible_row.style.backgroundColor =
            i % 2 == 0 ? "transparent" : "#0000000b";
        });
        }

        table_headings.forEach((head, i) => {
        let sort_asc = true;
        head.onclick = () => {
            table_headings.forEach((head) => head.classList.remove("active"));
            head.classList.add("active");
            document
            .querySelectorAll("td")
            .forEach((td) => td.classList.remove("active"));
            table_rows.forEach((row) => {
            row.querySelectorAll("td")[i].classList.add("active");
            });
            head.classList.toggle("asc", sort_asc);
            sort_asc = head.classList.contains("asc") ? false : true;
            sortTable(i, sort_asc);
        };
        });

        function sortTable(column, sort_asc) {
        const rowsToSort = [...table_rows].slice(1);
        rowsToSort
            .sort((a, b) => {
            let first_row = a
                .querySelectorAll("td")
                [column].textContent.toLowerCase(),
                second_row = b.querySelectorAll("td")[column].textContent.toLowerCase();
            return sort_asc
                ? first_row < second_row
                ? 1
                : -1
                : first_row < second_row
                ? -1
                : 1;
            })
            .map((sorted_row) =>
            document.querySelector("tbody").appendChild(sorted_row)
            );
        }

    </script>
</body>

</html>