<?php 
    session_start();
    include_once "db_con.php";

    $acc_id = $_SESSION['acc_id'];
    $acc_role = $_SESSION['role'];

    if ($acc_role == 'user'){
        $sql1 = "SELECT user_id FROM user_list WHERE acc_id = $acc_id";
        $query1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_assoc($query1);
        $outgoing_id = $row1['user_id'];
    } else {
        $sql1 = "SELECT org_id FROM org_list WHERE acc_id = $acc_id";
        $query1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_assoc($query1);
        $outgoing_id = $row1['org_id'];
    }

    $incoming_id = mysqli_real_escape_string($con, $_POST['incoming_id']);
    
    if ($incoming_id === 'website') {
        // If incoming_id is "website", skip the rest of the code
        exit();
    }

    $output = "";
    $sql = "SELECT * FROM chats
            WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY chat_id";
    $query = mysqli_query($con, $sql);

    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            if($row['outgoing_msg_id'] === $outgoing_id){
                $output .= '<div class="chat outgoing">
                            <div class="details">
                                <p>'. $row['msg'] .'</p>
                            </div>
                            </div>';
            } else {
                $output .= '<div class="chat incoming">
                            <div class="details">
                                <p>'. $row['msg'] .'</p>
                            </div>
                            </div>';
            }
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send message they will appear here.</div>';
    }

    echo $output;
?>
