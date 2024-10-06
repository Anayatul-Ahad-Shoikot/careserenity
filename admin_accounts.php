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
                    <h1>Orphans</h1>
                </div>
            </div>

            <div class="table-dataa">

                <div class="order">
                    <table>
                        <thead style="position:stick;">
                            <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Religion</th>
                                <th>From</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Adoption</th>
                                <th>Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = "SELECT a.acc_id, a.acc_email, a.role, a.acc_join_date, 
                                IF(a.role = 'org', o.org_name, u.user_name) AS name, 
                                IF(a.role = 'org', o.org_email, u.user_contact) AS contact, 
                                IF(a.role = 'org', o.org_location, u.user_location) AS location, 
                                IF(a.role = 'org', o.org_website, u.user_website) AS website,
                                IF(a.role = 'org', o.org_logo, u.user_image) AS image
                                FROM accounts AS a
                                LEFT JOIN org_list AS o ON a.acc_id = o.acc_id AND a.role = 'org'
                                LEFT JOIN user_list AS u ON a.acc_id = u.acc_id AND a.role = 'user'";
                
                                $result = mysqli_query($con, $query);
                            
                                if (mysqli_num_rows($result) > 0) {
                                    echo '<table>
                                            <thead>
                                                <tr>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Contact</th>
                                                    <th>Location</th>
                                                    <th>Website</th>
                                                    <th>Join Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>';
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>
                                                <td><img src="./assets/' . $row['image'] . '" alt="Profile Image" width="50" height="50"></td>
                                                <td>' . $row['name'] . '</td>
                                                <td>' . $row['acc_email'] . '</td>
                                                <td>' . $row['contact'] . '</td>
                                                <td>' . $row['location'] . '</td>
                                                <td>' . $row['website'] . '</td>
                                                <td>' . $row['acc_join_date'] . '</td>
                                                </tr>';
                                    }
                                    echo '</tbody></table>';
                                } else {
                                    echo '<tr><td colspan="7">No accounts found.</td></tr>';
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