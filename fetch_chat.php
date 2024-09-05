<?php
    include_once "db_con.php";
    session_start();
    $acc_role = $_SESSION['role'];
    $out_id = mysqli_real_escape_string($con, $_POST['out_id']);
    $in_id = mysqli_real_escape_string($con, $_POST['in_id']);

    // Check if the incoming ID is "website"
    if ($in_id === 'website') {
        $output = '<header>
                    <img src="/Icons&logos/LOGO.png" alt="">
                    <div class="details">
                        <span>CareSerenity.org</span>
                    </div>
                </header>
                <div class="chat-box">';

        // Fetch and display messages with "website" interaction
        $sql2 = "SELECT * FROM chats WHERE outgoing_msg_id = '$out_id' AND incoming_msg_id = 'website' OR outgoing_msg_id = 'website' AND incoming_msg_id = '$out_id' ORDER BY timestamp ASC";
        $query2 = mysqli_query($con, $sql2);

        while ($row2 = mysqli_fetch_assoc($query2)) {
            // Assuming "website" messages are displayed as system messages
            $output .= '<div class="chat">
                            <div class="details">
                                <p>' . $row2['msg'] . '</p>
                            </div>
                        </div>';
        }

        $output .= '</div>
                    <form action="#" class="typing-area">
                        <input type="text" class="incoming_id" name="incoming_id" value="'. $in_id .'" hidden>
                        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off" disabled>
                        <input type="text" name="outgoing_id" value="'. $out_id .'" hidden>
                        <button id="button-30" disabled>Send</button>
                    </form>';
        echo $output;

    } else if ($acc_role == 'user') {
        $sql1 = "SELECT org_name, org_logo, org_id FROM org_list WHERE org_id = $in_id";
        $query1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_assoc($query1);

        $output = '<header>
                <img src="/UserImage/accountPic/' . $row1['org_logo'] . '" alt="">
                <div class="details">
                    <a href="/FrontEnd/loggedIn/userpage/see_organization_profile.php?org_id=' . $row1['org_id'] . '">' . $row1['org_name'] . '</a>
                </div>
            </header>
            <div class="chat-box">';

        // Fetch and display messages
        $sql2 = "SELECT * FROM chats WHERE outgoing_msg_id = '$out_id' AND incoming_msg_id = '$in_id' OR outgoing_msg_id = '$in_id' AND incoming_msg_id = '$out_id' ORDER BY timestamp ASC";
        $query2 = mysqli_query($con, $sql2);

        while ($row2 = mysqli_fetch_assoc($query2)) {
            $output .= '<div class="chat">
                            <div class="details">
                                <p>' . $row2['msg'] . '</p>
                            </div>
                        </div>';
        }

        $output .= '</div>
            <form action="#" class="typing-area">
                <input type="text" class="incoming_id" name="incoming_id" value="'. $in_id .'" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                <input type="text" name="outgoing_id" value="'. $out_id .'" hidden>
                <button id="button-30">Send</button>
            </form>';
        echo $output;

    } else if ($acc_role == 'org') {
        $sql1 = "SELECT user_name, user_image FROM user_list WHERE user_id = $in_id";
        $query1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_assoc($query1);

        $output = '<header>
                <img src="/UserImage/accountPic/' . $row1['user_image'] . '" alt="">
                <div class="details">
                    <span>' . $row1['user_name'] . '</span>
                </div>
            </header>
            <div class="chat-box">';

        // Fetch and display messages
        $sql2 = "SELECT * FROM chats WHERE outgoing_msg_id = '$out_id' AND incoming_msg_id = '$in_id' OR outgoing_msg_id = '$in_id' AND incoming_msg_id = '$out_id' ORDER BY timestamp ASC";
        $query2 = mysqli_query($con, $sql2);

        while ($row2 = mysqli_fetch_assoc($query2)) {
            $output .= '<div class="chat">
                            <div class="details">
                                <p>' . $row2['msg'] . '</p>
                            </div>
                        </div>';
        }

        $output .= '</div>
            <form action="#" class="typing-area">
                <input type="text" class="incoming_id" name="incoming_id" value="'. $in_id .'" hidden>
                <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
                <input type="text" name="outgoing_id" value="'. $out_id .'" hidden>
                <button id="button-30">Send</button>
            </form>';
        echo $output;
    } else {
        echo 'Invalid role!';
    }
?>
