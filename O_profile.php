<?php
    include("../../../BackEnd/organization_profile_fetch_BE.php");
    include('../../../BackEnd/adoption_request_fetch_BE.php');
    include('../../../BackEnd/donation_request_fetch_BE.php');
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
    <link rel="stylesheet" href="/FrontEnd/css/profile.css">
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
                <img src="../../../UserImage/accountPic/<?php echo $org_logo ?>" alt="profile" width="250px" height="250px">
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
            <a href="chat.php" id="button-30">Chats</a>
            <a href="orphan.php" id="button-30">Orphanage</a>
            <a href="volunteer.php" id="button-30">Volunteers</a>
            <a href="profile_edit.php" id="button-30">Profile Info</a>
        </div>


        <div class="short-report">
            <li>
                <a href="#"><i class='bx bxs-dollar-circle'></i></a>
                <span>
                    <p>Donation Received</p>
                    <h3>678</h3>
                </span>
            </li>
            <li>
                <a href="#"><i class='bx bxs-face' ></i></i></a>
                <span>
                    <p>Adoption Requests</p>
                    <h3><?php echo $total_adoptions ?></h3>
                </span>
            </li>
            <li>
                <a href="#"><i class='bx bxs-user-plus' ></i></a>
                <span>
                    <p>Volunteers</p>
                    <h3>9</h3>
                </span>
            </li>
            <li>
                <a href="#"><i class='bx bxs-report'></i></i></a>
                <span>
                    <p>Reports</p>
                    <h3>4</h3>
                </span>
            </li>
        </div>


        <div class="info-containers">
            <div class="inbox">
                <div class="search">
                    <input type="text" placeholder="Search...">
                </div>
                <div class="search-list">

                </div>
                <div class="inbox-list">
                    <p>Previous chats</p>
                    <?php
                        include '../../../BackEnd/chat_previous_list_BE.php';
                    ?>
                </div>
            </div>

            <div class="adoption-donation">

                <div class="adoption">
                    <h3 id="heading">Adoption Requests</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Requested by</th>
                                <th>Requested for</th>
                                <th class="x">Action</th>
                                <th>Process</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            
                            foreach ($namesArray as $names) {
                                echo '<tr>
                                                <td>
                                                    <a href="see_user_profile.php?user_id=' . $names['user_id'] . '">' . $names['user_name'] . '</a>
                                                </td>
                                                <td>
                                                    <a href="orphan_profile.php?orphan_id=' . $names['orphan_id'] . '">' . $names['first_name'] . '</a>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button onclick="toggleDropdown(this)" class="dropbtn">Actions</button>
                                                        <div id="myDropdown" class="dropdown-content">
                                                            <a href="adoption_request_details.php?adoption_id=' . $names['adoption_id'] . '&user_name=' . $names['user_name'] . '&first_name=' . $names['first_name'] . '">View</a>
                                                            <a href="/Root/D & A/Org_donation_adoption/ACCEPT_ADOPTION_REQUEST_BE.php?adoption_id=' . $names['adoption_id'] . '&user_id=' . $names['user_id'] . '&orphan_id=' . $names['orphan_id'] . '">Accept</a>
                                                            <a href="reject?adoption_id="' . $names['adoption_id'] . '">Reject</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="' . ($names['status'] === 'done' ? 'done-status' : 'pending-status') . '">
                                                        ' . $names['status'] . '
                                                    </p>
                                                </td>
                                            </tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                
                <div class="donation">
                    <h3 id="heading">Donation Received</h3>
                    <ul class="donation-list">
                        <?php
                    
                        foreach ($resultArray as $y) {
                            if ($y['receiver_type'] === 'organization') {
                                echo '<li class="completed"><p>Donation Received ' . $y['amount'] . 'TK from <a href="#?user_id=' . $y['user_id'] . '">' . $y['user_name'] . '</a></p></li>';
                            } elseif ($y['receiver_type'] === 'orphan') {
                                echo '<li class="not-completed"><p>' . $y['first_name'] . ' ' . $y['last_name'] . ' received ' . $y['amount'] . 'TK from <a href="#?user_id=' . $y['user_id'] . '">' . $y['user_name'] . '</a></p></li>';
                            }
                        }
                        ?>
                    </ul>
                </div>

            </div>
            
        </div>
        <div class="chatbox hide">

</div>
    </div>

    <div class="chatbox hide">

    </div>

    <?php include "../../components/footer.php" ?>

    <button id="scrollTopBtn" title="Go to top"><i class='bx bx-chevrons-up bx-burst' ></i></button>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Initially hide the chatbox
            const chatbox = document.querySelector(".chatbox");
            const chatboxHeaderImg = document.getElementById("chatbox-header-img");
            const chatboxHeaderName = document.getElementById("chatbox-header-name");

            // Function to add click listeners to the inbox list items
            function addClickListenersToInboxList() {
                const links = document.querySelectorAll(".inbox-list a");
                links.forEach(link => {
                    link.addEventListener("click", function(event) {
                        event.preventDefault(); // Prevent the default link behavior
                        // Show the chatbox when a link is clicked
                        chatbox.classList.remove("hide");

                        // Fetch and update chatbox header
                        const outId = this.dataset.out_id;
                        const inId = this.dataset.in_id;
                        fetchChatboxHeaderData(outId, inId);
                    });
                });
            }

            // Function to fetch chatbox header data
            function fetchChatboxHeaderData(outId, inId) {
                fetch('fetch_chat_list.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ out_id: outId, in_id: inId })
                })
                .then(response => response.json())
                .then(data => {
                    chatboxHeaderImg.src = data.image;
                    chatboxHeaderName.textContent = data.name;
                })
                .catch(error => console.error('Error fetching chatbox header data:', error));
            }

            // Call the function to add listeners to inbox list items
            addClickListenersToInboxList();
        });
    </script>
    <script src="/FrontEnd/js/scrollupBTN.js"></script>
    <script src="/FrontEnd/js/notification_color.js"></script>
    <script src="/FrontEnd/js/feedback.js"></script>
</body>

</html>