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
                    <a href="./admin_orphan.php"><i class="fa fa-child" aria-hidden="true"></i></a>
                    <span class="text">
                        <p>Orphans</p>
                        <h3><?php echo $total_orphans ?></h3>
                    </span>
                </li>
                <li>
                    <a href="./admin_organization.php"><i class="fa fa-building" aria-hidden="true"></i></a>
                    <span class="text">
                        <p>Organizations</p>
                        <h3><?php echo $total_organizations ?></h3>
                    </span>
                </li>
                <li>
                    <a href="/Root/Admin_Side/Dash/Users/USER_DASH.php"><i class="fa fa-users" aria-hidden="true"></i></a>
                    <span class="text">
                        <p>Users</p>
                        <h3><?php echo $total_users ?></h3>
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
                        <h3>Blogs :</h3>
                        <!-- <i class="fas fa-search"></i> -->
                        <i class="fas fa-filter"></i>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th class="x"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('./db_con.php');
                            $query = "SELECT u.post_image, u.post_title, u.post_id, a.acc_id
                                            FROM blog_post AS u
                                            LEFT JOIN accounts AS a
                                            ON u.acc_id = a.acc_id
                                            ORDER BY published DESC";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>
                                                <td>
                                                <img src="./assets/' . $row['post_image'] . '" alt="" />
                                                <p>' . $row['post_title'] . '</p>
                                                </td>
                                                <td>
                                                    <div class="btn">
                                                        <a href="./admin_remove_BE.php?post_id=' . $row['post_id'] . '" id="button-30">remove</a>
                                                    </div>
                                                </td>
                                            </tr>';
                                }
                            } else {
                                echo 'No blogs are available.';
                            }
                            mysqli_close($con);
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="order">
                    <div class="head">
                        <h3>Seminars :</h3>
                        <!-- <i class="fas fa-search"></i> -->
                        <i class="fas fa-filter"></i>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>From</th>
                                <th class="x"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('./db_con.php');
                            $query = "SELECT s.seminar_id, s.title, s.org_id, s.banner, o.org_name
                                            FROM seminars AS s
                                            LEFT JOIN org_list AS o
                                            ON o.org_id = s.org_id
                                            ORDER BY s.created_at DESC";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>
                                                <td>
                                                    <img src="./assets/' . $row['banner'] . '" alt="" />
                                                    <p>' . $row['title'] . '</p>
                                                </td>
                                                <td><p>' . $row['org_name'] . '</p></td>
                                                <td>
                                                    <div class="btn">
                                                        <a href="./admin_remove_BE.php?seminar_id=' . $row['seminar_id'] . '" id="button-30">remove</a>
                                                    </div>
                                                </td>
                                            </tr>';
                                }
                            } else {
                                echo 'No seminars are available.';
                            }
                            mysqli_close($con);
                            ?>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="table-data">

                <div class="order">
                    <div class="head">
                        <h3>Funds :</h3>
                        <!-- <i class="fas fa-search"></i> -->
                        <i class="fas fa-filter"></i>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>From</th>
                                <th class="x"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('./db_con.php');
                            $query = "SELECT s.fund_id, s.name, s.org_id, s.img, s.amount, o.org_name
                                            FROM funds AS s
                                            LEFT JOIN org_list AS o
                                            ON o.org_id = s.org_id
                                            ORDER BY s.fund_id DESC";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>
                                                <td>
                                                <img src="./assets/' . $row['img'] . '" alt="" />
                                                <p>' . $row['name'] . ' (' . $row['amount'] . ')</p>
                                                </td>
                                                <td><p>' . $row['org_name'] . '</p></td>
                                                <td>
                                                    <div class="btn">
                                                        <a href="./admin_remove_BE.php?fund_id=' . $row['fund_id'] . '" id="button-30">remove</a>
                                                    </div>
                                                </td>
                                            </tr>';
                                }
                            } else {
                                echo 'No funds are available.';
                            }
                            mysqli_close($con);
                            ?>
                        </tbody>
                    </table>
                </div>

                <div class="order">
                    <div class="head">
                        <h3>Volunteer Recruites :</h3>
                        <!-- <i class="fas fa-search"></i> -->
                        <i class="fas fa-filter"></i>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>From</th>
                                <th>For</th>
                                <th class="x"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include('./db_con.php');
                            $query = "SELECT s.recruite_id, s.seminar_id, o.org_logo, o.org_name, ss.title
                                            FROM volunteer_recruite AS s
                                            LEFT JOIN org_list AS o
                                            ON o.org_id = s.org_id
                                            LEFT JOIN seminars AS ss
                                            ON ss.seminar_id = s.seminar_id";
                            $result = mysqli_query($con, $query);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<tr>
                                                <td>
                                                    <img src="./assets/' . $row['org_logo'] . '" alt="" />
                                                    <p>' . $row['org_name'] . '</p>
                                                </td>
                                                <td><p>' . $row['title'] . '</p></td>
                                                <td>
                                                    <div class="btn">
                                                        <a href="./admin_remove_BE.php?recruite_id=' . $row['recruite_id'] . '" id="button-30">remove</a>
                                                    </div>
                                                </td>
                                            </tr>';
                                }
                            } else {
                                echo 'No blog posts found.';
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