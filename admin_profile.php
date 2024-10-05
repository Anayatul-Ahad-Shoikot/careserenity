<?php
include('./admin_dashboard_BE.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./css/admin_profile.css" />
    <link rel="stylesheet" href="./css/admin_dashboard.css" />
    <title>Admins</title>
</head>

<body>

    <section class="sidebar">
        <a href="./admin_dashboard.php" class="logo">
            <img src="./assets/LOGO.png" alt="">
        </a>

        <ul class="side-menu top">
            <li>
                <a href="./admin_dashboard.php" class="nav-link">
                    <i class="fas fa-border-all"></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li  class="active">
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
        <nav>
            <i class="fas fa-bars menu-btn"></i>
            <form action="#" style="visibility: hidden;">
                <div class="form-input">
                    <input type="search" placeholder="search..." />
                    <button class="search-btn">
                        <i class="fas fa-search search-icon"></i>
                    </button>
                </div>
            </form>
            <a href="#" class="profile">
                <img src="./assets/<?php echo $admin_image ?>" alt="profile" />
            </a>
        </nav>

        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Admin</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a class="active" href="./admin_dashboard.php">Dashboard</a>
                        </li>
                        <li>></li>
                        <li>
                            <a class="active" href="#">Admin Profile</a>
                        </li>
                    </ul>
                </div>

                <div class="ctn" style="visibility: hidden;">
                    <form action="#" method="GET">
                        <input type="text" name="query" placeholder="Search Child">
                        <button type="submit" class="btn"><i class="ri-search-line"></i></button>
                    </form>
                </div>
            </div>

            <div class="container">
                <div class="box st st">
                    <?php
                        include('./db_con.php');
                        $acc_idd = $_SESSION['acc_id'];
                        $sql = "SELECT x.*, y.acc_email, y.acc_join_date FROM admin_list AS x LEFT JOIN accounts AS y ON x.acc_id = y.acc_id WHERE x.acc_id != $acc_idd";
                        $result = mysqli_query($con, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                echo '<div class="box st">';
                                echo '<h1>Other Admins</h1>';
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo  '<div>
                                                <img src="./assets/' . $row['admin_image'] . '" alt="" style="border-radius: 50%;">
                                            </div>
                                            <form action="./admin_remove_admin.php" method="POST">
                                                <input type="text" name="admin_name" placeholder="' . $row['admin_name'] . '" disabled>
                                                <input type="text" name="acc_email" placeholder="' . $row['acc_email'] . '" disabled>
                                                <input type="text" name="admin_contact" placeholder="' . $row['admin_contact'] . '" disabled>
                                                <input type="text" name="admin_priyority" placeholder="' . $row['admin_priyority'] . '" disabled>
                                                <input type="text" name="acc_join_date" placeholder="' . $row['acc_join_date'] . '" disabled>
                                                <input type="hidden" name="acc_id" value="' . $row['acc_id'] . '">
                                                <input type="hidden" name="admin_id" value="' . $row['admin_id'] . '">
                                                <button type="submit" name="delete">Remove</button>
                                            </form>';
                                }
                                echo '</div>';
                            } else {
                                echo "No admins Found";
                            }
                        mysqli_close($con);
                    ?>
                </div>
                <div class="box st">
                    <h1>My Deteails</h1>
                    <div>
                        <img src="./assets/<?php echo $admin_image ?>" alt="User Image">
                    </div>
                    <form action="./admin_update_BE.php" method="POST" enctype="multipart/form-data">
                        <input type="text" name="admin_name" placeholder="<?php echo $admin_name ?>">
                        <input type="text" name="acc_email" placeholder="<?php echo $admin_email ?>">
                        <input type="text" name="admin_contact" placeholder="<?php echo $admin_contact ?>">
                        <input type="text" name="admin_priyority" placeholder="<?php echo $admin_priyority ?>" disabled>
                        <input type="text" name="acc_join_date" placeholder="<?php echo $acc_join_date ?>" disabled>
                        <input type="file" name="image" accept="image/*">
                        <button type="submit" name="submit1">Update</button>
                    </form>
                </div>
                <div class="box nd">
                    <h1>Add Admin</h1>
                    <div>
                        <form action="./admin_add_admin_BE.php" method="POST" enctype="multipart/form-data">
                            <input type="text" name="admin_name" placeholder="Admin Name" required>
                            <input type="text" name="acc_email" placeholder="Admin Email" required>
                            <input type="text" name="admin_contact" placeholder="contact number" required>
                            <input type="text" name="admin_priyority" placeholder="Set priyority" required>
                            <input type="password" name="acc_pass" placeholder="Password" required>
                            <input type="password" name="con_pass" placeholder="Confirm Password" required>
                            <input type="password" name="Admin_pass" placeholder="Enter Your Password" required>
                            <input type="file" name="image" accept="image/*">
                            <button type="submit" name="submit2">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>

    </section>

    <script src="./js/admin_dashboard.js"></script>
</body>

</html>