<?php
include("./O_profile_fetch_BE.php");
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
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./css/colors.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/profile.css">
    <link rel="stylesheet" href="./css/fund.css">
    <link rel="stylesheet" href="./css/adoption.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/notification.css">
    <link rel="stylesheet" href="./css/feedback.css">
    <link rel="icon" href="./assets/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Profile </title>
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
            <a onclick="showForm(this)" id="button-30">Fund+</a>
            <a onclick="showExpenses()" id="button-30">Expenses</a>
            <a href="./O_donation.php" id="button-30">Donations</a>
            <a href="./O_profile.php" id="button-30">Back</a>
        </div>

        <div class="FundForm">
            <form action="./O_fund_BE.php" method="POST" enctype="multipart/form-data">
                <h1>Fund Raising Form</h1>
                <div class="form_row">
                    <label for="name">Name your fund :</label>
                    <input type="text" name="name" required>
                </div>
                <div class="form_row">
                    <label for="">Fund Amount :</label>
                    <input type="number" name="amount" required>
                </div>
                <div class="form_row">
                    <label for="duration">Duration</label>
                    <input type="date" name="duration" required>
                </div>
                <div class="form_row">
                    <label for="img">Banner :</label>
                    <input type="file" name="img" required>
                </div>
                <input type="hidden" name="org_id" value="<?php echo $org_id ?>">
                <button type="submit" id="button-30">Create</button>
            </form>
        </div>

        <div class="MyFunds">
            <h1>My Funds :</h1>
            <div class="row">
                <?php include("./O_fund_fetch_BE.php") ?>
            </div>
        </div>

        <div class="FundList">
            <h1>Fund received List :</h1>
            <section class="table__body">
                <table>
                    <thead>
                        <tr>
                            <th> Date </th>
                            <th> Fund </th>
                            <th> From </th>
                            <th> Bkash_no </th>
                            <th> Card_no </th>
                            <th> Amount </th>
                            <th> Action </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php include("./O_fund_fetch_all_BE.php") ?>
                    </tbody>
                </table>
            </section>
        </div>

    </div>

    <?php include "./footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst'></i></button>

    <script src="./js/scrollupBTN.js"></script>
    <script src="./js/notification_color.js"></script>
    <script src="./js/feedback.js"></script>
    <script src="./js/fundForm.js"></script>
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