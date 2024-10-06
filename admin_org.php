<?php
include('./admin_dashboard_BE.php');
include('./index_BE.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="./css/admin_dashboard.css" />
    <title>CareSerenity | Admin Panel</title>
</head>

<body>

    <section class="sidebar">
        <a href="./admin_dashboard.php" class="logo">
            <img src="./assets/LOGO.png" alt="">
        </a>

        <ul class="side-menu top">
            <li class="active">
                <a href="./admin_dashboard.php" class="nav-link">
                    <i class="fas fa-border-all"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="./admin_profile.php" class="nav-link">
                    <i class="fas fa-people-group"></i>
                    <span class="text">Team</span>
                </a>
            </li>
            <li>
                <a href="./login_BE.php" class="logout">
                    <i class="fas fa-right-from-bracket"></i>
                    <span class="text">Logout</span>
                </a>
            </li>
        </ul>
    </section>


    <section class="content">
        <nav class="e">
            <i class="fas fa-bars menu-btn"></i>
            <form action="#" style="visibility: hidden;">
                <div class="form-input">
                    <input type="search" placeholder="search..." />
                    <button class="search-btn"><i class="fas fa-search search-icon"></i></button>
                </div>
            </form>
            <a href="./admin_profile.php" class="profile">
                <img src="./assets/<?php echo $admin_image ?>" alt="profile" />
            </a>
        </nav>

        <main>

            <div class="head-title">
                <div class="left">
                    <h1>Dashboard</h1>
                </div>
            </div>

            <div class="box-info fst">
                <li>
                    <a href="/Root/Admin_Side/Dash/Orphans/ORPHAN_DASH.php"><i class="fa fa-child" aria-hidden="true"></i></a>
                    <span class="text">
                        <p>Orphans</p>
                        <h3><?php echo $total_orphans ?></h3>
                    </span>
                </li>
            </div>

            <div class="box-info sec">
                <li>
                    <a href="#"><i class="fa fa-id-badge" aria-hidden="true"></i></a>
                    <span class="text">
                        <p>Accounts</p>
                        <h3><?php echo $total_accounts ?></h3>
                    </span>
                </li>
                <li>
                    <a href="./admin_profile.php"><i class="fa fa-user-secret" aria-hidden="true"></i></a>
                    <span class="text">
                        <p>Admins</p>
                        <h3><?php echo $total_admins ?></h3>
                    </span>
                </li>
                <li style="visibility:hidden;">
                    <i class="fas fa-calendar-check"></i>
                    <span class="text">
                        <p>Accounts</p>
                        <h3>1.5K</h3>
                    </span>
                </li>
            </div>

            <div class="table-data">

                <div class="order">
                    <div class="head">
                        <h3>Orphans :</h3>
                        <i class="fas fa-filter"></i>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th class="x"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include('./db_con.php');
                                $query = "SELECT * FROM org_list";
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>
                                                <td>' . $row['org_name'] . ' ' . $row['last_name'] . '</td>
                                                <td>' . $row['org_description'] . '</td>
                                                <td>' . $row['org_email'] . '</td>
                                                <td>' . $row['org_phone'] . '</td>
                                                <td>' . $row['org_website'] . '</td>
                                                <td>' . $row['org_logo'] . '</td>
                                                <td>' . $row['established'] . '</td>
                                                <td>' . $row['org_location'] . '</td>
                                                <td>' . $row['org_vision'] . '</td>
                                                <td>' . $row['org_review'] . '</td>
                                                <td>
                                                    <div class="btn">
                                                        <a href="./admin_remove_organizations.php?orphan_id=' . $row['org_id'] . '" id="button-30">Remove</a>
                                                    </div>
                                                </td>
                                            </tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="11">No orphans are available.</td></tr>';
                                }
                                mysqli_close($con);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>

    </section>

    <script src="./js/admin_dashboard.js"></script>
</body>

</html>