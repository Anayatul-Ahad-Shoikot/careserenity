<?php

include "db_con.php";

$acc_id = $_SESSION['acc_id'];
$acc_role = $_SESSION['role'];

if ($acc_role == 'user') {
    $sql3 = "SELECT user_id FROM user_list WHERE acc_id = $acc_id";
} else {
    $sql3 = "SELECT org_id FROM org_list WHERE acc_id = $acc_id";
}
$query3 = mysqli_query($con, $sql3);
$row3 = mysqli_fetch_assoc($query3);
$outgoing_id = ($acc_role == 'user') ? $row3['user_id'] : $row3['org_id'];

$sql = "
    SELECT
        CASE
            WHEN outgoing_msg_id = '$outgoing_id' THEN incoming_msg_id
            ELSE outgoing_msg_id
        END AS interacted_id,
        MAX(timestamp) AS latest_timestamp
    FROM chats
    WHERE '$outgoing_id' IN (outgoing_msg_id, incoming_msg_id) OR 'website' IN (outgoing_msg_id, incoming_msg_id)
    GROUP BY interacted_id
    ORDER BY latest_timestamp DESC
";

$query = mysqli_query($con, $sql);

if (mysqli_num_rows($query) > 0) {
    $interacted_ids = [];
    while ($row = mysqli_fetch_assoc($query)) {
        $interacted_ids[] = $row['interacted_id'];
    }

    // Check if 'website' is in the interacted_ids and handle it separately
    $is_website_included = in_array('website', $interacted_ids);
    if ($is_website_included) {
        // Display the website interaction
        echo '<a onclick="addClickListenersToInboxList();" data-out_id="'. $outgoing_id .'" data-in_id="website">
                <div class="content">
                    <img src="/Icons&logos/LOGO.png" alt="Logo">
                    <div class="details">
                        <span>CareSerenity.org</span>
                    </div>
                </div>
            </a>';
        
        $interacted_ids = array_filter($interacted_ids, function($id) {
            return $id !== 'website';
        });
    }

    if (!empty($interacted_ids)) {
        $interacted_ids_str = implode(',', $interacted_ids);

        $sql_users = "
            SELECT user_id AS id, user_name AS name, user_image AS image 
            FROM user_list 
            WHERE user_id IN ($interacted_ids_str)
        ";

        $sql_orgs = "
            SELECT org_id AS id, org_name AS name, org_logo AS image 
            FROM org_list 
            WHERE org_id IN ($interacted_ids_str)
        ";

        $users_query = mysqli_query($con, $sql_users);
        $orgs_query = mysqli_query($con, $sql_orgs);

        while ($user = mysqli_fetch_assoc($users_query)) {
            echo '<a onclick="addClickListenersToInboxList();" data-out_id="'. $outgoing_id .'" data-in_id="' . $user['id'] . '">
                    <div class="content">
                        <img src="/UserImage/accountPic/'. $user['image'] .'" alt="">
                        <div class="details">
                            <span>'. $user['name'] .'</span>
                        </div>
                    </div>
                </a>';
        }

        while ($org = mysqli_fetch_assoc($orgs_query)) {
            echo '<a onclick="addClickListenersToInboxList();" data-out_id="'. $outgoing_id .'" data-in_id="' . $org['id'] . '">
                    <div class="content">
                        <img src="/UserImage/accountPic/'. $org['image'] .'" alt="">
                        <div class="details">
                            <span>'. $org['name'] .'</span>
                        </div>
                    </div>
                </a>';
        }
    }
} else {
    echo 'No interactions found!';
}
?>
