<?php
    include("../../../BackEnd/organization_profile_fetch_BE.php");
    include("../../../BackEnd/orphan_profile_fetch_BE.php");
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
    <link rel="stylesheet" href="/FrontEnd/css/colors.css">
    <link rel="stylesheet" href="/FrontEnd/css/navbar.css">
    <link rel="stylesheet" href="/FrontEnd/css/orphan_profile.css">
    <link rel="stylesheet" href="/FrontEnd/css/footer.css">
    <link rel="stylesheet" href="/FrontEnd/css/notification.css">
    <link rel="stylesheet" href="/FrontEnd/css/feedback.css">
    <link rel="icon" href="/Icons&logos/LOGO.png" type="image/x-icon">
    <title>CareSenerity | Profile </title>
</head>

<body>

    <?php include "../../components/navbarO.php" ?>

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
                <img src="../../../UserImage/childpic/<?php echo $orphan_image ?>" alt="profile">
            </div>
            <div class="account-data">
                <h1><?php echo $first_name ?></h1>
                <p>Belong to : <?php echo $org_name ?></p>
                <p>Location : <?php echo $org_location ?></p>
                <p>Email : <?php echo $org_email ?></p>
                <p>Contact : <?php echo $org_phone ?></p>
            </div>
            <div class="biography">
                <h1>Local Guardian info :</h1>
                <p>Name : <?php echo $guardian_name ?></p>
                <p>Contact : <?php echo $guardian_contact ?></p>
                <p>Address : <?php echo $guardian_location ?></p>
            </div>
        </div>

        <div class="options">
            <a href="see_organization_orphanage.php?org_id=<?php echo $org_id ?>" class="btn">back</a>
        </div>


        <div class="form">
            <h2>Profile Information</h2>
            <form>
                <div class="form_row">
                    <label>Full Name:</label>
                    <input type="text" name="first_name" placeholder="<?php echo $first_name ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Age:</label>
                    <input type="number" name="age" placeholder="<?php echo $age ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Gender :</label>
                    <select name="gender" disabled>
                        <option value=""><?php echo $gender ?></option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form_row">
                    <label>Religion :</label>
                    <select name="religion" disabled>
                        <option value=''><?php echo $religion ?></option>
                        <option value="muslim">Muslim</option>
                        <option value="hindu">Hindu</option>
                        <option value="cristian">Cristian</option>
                        <option value="buddha">Buddha</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form_row">
                    <label>Date of Birth :</label>
                    <input type="text" name="date_of_birth" placeholder="<?php echo $date_of_birth ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Family Status :</label>
                    <select name="family_status" disabled>
                        <option value=''><?php echo $family_status ?></option>
                        <option value="abondoned">Abondoned</option>
                        <option value="past Away">Past Away</option>
                        <option value="unknow">Unknow</option>
                        <option value="lost">Lost</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div class="form_row">
                    <label>Physical Condition :</label>
                    <select name="physical_condition" disabled>
                        <option value=''><?php echo $physical_condition ?></option>
                        <option value="good">Good</option>
                        <option value="blind">Blind</option>
                        <option value="deaf">Deaf</option>
                        <option value="disabled">Disabled</option>
                        <option value="autistic">Autistic</option>
                        <option value="mad">Mad</option>
                    </select>
                </div>
                <div class="form_row">
                    <label>Education level:</label>
                    <select name="education_level" disabled>
                        <option value=''><?php echo $education_level ?></option>
                        <option value="kindergarten">Kindergarten</option>
                        <option value="elementary">Elementary</option>
                        <option value="primary_school">Primary School</option>
                        <option value="junior_high_school">Junior High School</option>
                        <option value="senior_high_school">Senior High School</option>
                        <option value="secondary_school">secondary_school</option>
                    </select>
                </div>
                <div class="form_row">
                    <label>Medical History:</label>
                    <input type="text" name="medical_history" placeholder="<?php echo $medical_history ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Hobby:</label>
                    <input type="text" name="hobby" placeholder="<?php echo $hobby ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Favourite Food:</label>
                    <input type="text" name="favorite_food" placeholder="<?php echo $favorite_food ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Favourite Games:</label>
                    <input type="text" name="favorite_game" placeholder="<?php echo $favorite_game ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Skills:</label>
                    <input type="text" name="skills" placeholder="<?php echo $skills ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Dreams:</label>
                    <input type="text" name="dreams" placeholder="<?php echo $dreams ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Problems:</label>
                    <input type="text" name="problems" placeholder="<?php echo $problems ?>" disabled>
                </div>
                <div class="form_row">
                    <label>Comments:</label>
                    <input type="text" name="other_comments" placeholder="<?php echo $other_comments ?>" disabled>
                </div>
                <div class="form_row">
                    <label>adoption_status :</label>
                    <input type="text" name="adoption_status" placeholder="<?php echo $adoption_status ?>" disabled>
                </div>
                <input type="hidden" name="orphan_id" value="<?php echo $row['orphan_id'] ?>">
                <input type="hidden" name="guardian_id" value="<?php echo $row['guardian_id'] ?>">
                <div class="btn">
                    <!-- <button type="submit" name="update">Update</button> -->
                    need to add buttons for adopt request
                </div>
            </form>
        </div>

    </div>

    <?php include "../../components/footer.php" ?>

    <button id="scrollTopBtn" title="Go to top">↑</button>

    <script src="/FrontEnd/js/scrollupBTN.js"></script>
    <script src="/FrontEnd/js/notification_color.js"></script>
    <script src="/FrontEnd/js/feedback.js"></script>

</body>

</html>