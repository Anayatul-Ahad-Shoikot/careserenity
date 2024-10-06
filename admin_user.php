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
    <link rel="stylesheet" href="./css/admin_table_list.css">
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
                    <h1>Organizations</h1>
                </div>
            </div>

            <div class="table-dataa">

                <div class="order">

                    <table>
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Birth</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Adopted</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include('./db_con.php');
                                $query = "SELECT u.*, a.acc_email FROM user_list AS u
                                            INNER JOIN accounts AS a ON a.acc_id = u.acc_id";
                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>
                                                <td><img src="./assets/' . $row['user_image'] . '"></td>
                                                <td>' . $row['user_name'] . '</td>
                                                <td>' . $row['user_gender'] . '</td>
                                                <td>' . $row['user_birth'] . '</td>
                                                <td>' . $row['user_contact'] . '</td>
                                                <td>' . $row['acc_email'] . '</td>
                                                <td>' . $row['user_address'] . '</td>
                                                <td>' . $row['child_adopted'] . '</td>
                                                <td>
                                                    <div class="btn">
                                                        <a href="./admin_user_remove.php?user_id=' . $row['user_id'] . '" id="button-30">Remove</a>
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