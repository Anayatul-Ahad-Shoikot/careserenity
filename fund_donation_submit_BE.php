<?php
    include('./db_con.php');
    session_start();
    if (isset($_POST['fund_donate_loggedout']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $fund_id = $_POST['fund_id'];
        $org_id = $_POST['org_id'];
        $donor_name = $_POST['donor_name'];
        $donor_email = $_POST['donor_email'];
        $pay = $_POST['pay'];
        $received_amount = $_POST['amount'];
        if ($pay == 'card') {
            $card_no = $_POST['card_no'];
            $stmt = $con->prepare("INSERT INTO fund_donation_received (fund_id, donor_name, donor_email, method, card_no, amount) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssi", $fund_id, $donor_name, $donor_email, $pay, $card_no, $received_amount);
            if ($stmt->execute()) {
                $content = "Fund Received: $received_amount Tk from $donor_name via card banking.";
                $stmt_notifications = $con->prepare("INSERT INTO notifications (org_id, content) VALUES (?, ?)");
                $stmt_notifications->bind_param("is", $org_id, $content);
                $stmt_notifications->execute();
                
                $query = "SELECT amount, received FROM funds WHERE fund_id = ?";
                $stmt2 = $con->prepare($query);
                $stmt2->bind_param("i", $fund_id);
                $stmt2->execute();
                $fund = $stmt2->get_result()->fetch_assoc();
                $Target_amount = $fund['amount'];
                $current_amount = $fund['received'];
                $new_current_amount = $current_amount + $received_amount;

                if($new_current_amount >= $Target_amount){
                    $update_query = "UPDATE funds SET received = ?, completed = 1 WHERE fund_id = ?";
                } else {
                    $update_query = "UPDATE funds SET received = ? WHERE fund_id = ?";
                }
                $update_stmt = $con->prepare($update_query);
                $update_stmt->bind_param("di", $new_current_amount, $fund_id);
                $update_stmt->execute();

                $_SESSION['positive'] = "Fund donated successfully.";
                header('Location: ./index.php');
                exit(0);
            } else {
                echo "Error in card donation: " . $stmt->error;
            }
        } else {
            $bkash_no = $_POST['bkash_no'];
            $stmt = $con->prepare("INSERT INTO fund_donation_received (fund_id, donor_name, donor_email, method, bkash_no, amount) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssi", $fund_id, $donor_name, $donor_email, $pay, $bkash_no, $received_amount);
            if ($stmt->execute()) {
                $content = "Fund Received: $received_amount Tk from $donor_name via Bkash.";
                $stmt_notifications = $con->prepare("INSERT INTO notifications (org_id, content) VALUES (?, ?)");
                $stmt_notifications->bind_param("is", $org_id, $content);
                $stmt_notifications->execute();

                $query = "SELECT amount, received FROM funds WHERE fund_id = ?";
                $stmt2 = $con->prepare($query);
                $stmt2->bind_param("i", $fund_id);
                $stmt2->execute();
                $fund = $stmt2->get_result()->fetch_assoc();
                $Target_amount = $fund['amount'];
                $current_amount = $fund['received'];
                $new_current_amount = $current_amount + $received_amount;

                if($new_current_amount >= $Target_amount){
                    $update_query = "UPDATE funds SET received = ?, completed = 1 WHERE fund_id = ?";
                } else {
                    $update_query = "UPDATE funds SET received = ? WHERE fund_id = ?";
                }
                $update_stmt = $con->prepare($update_query);
                $update_stmt->bind_param("di", $new_current_amount, $fund_id);
                $update_stmt->execute();


                $_SESSION['positive'] = "Fund donated successfully.";
                header('Location: ./index.php');
                exit(0);
            } else {
                echo "Error in Bkash donation: " . $stmt->error;
            }
        }
    } elseif(isset($_POST['fund_donate_loggedin']) && $_SERVER['REQUEST_METHOD'] == "POST") {
        $acc_id = $_SESSION['acc_id'];
        $fund_id = $_POST['fund_id'];
        $org_id = $_POST['org_id'];
        $donor_name = $_POST['donor_name'];
        $donor_email = $_POST['donor_email'];
        $pay = $_POST['pay'];
        $received_amount = $_POST['amount'];
        if ($pay == 'card') {
            $card_no = $_POST['card_no'];
            $stmt = $con->prepare("INSERT INTO fund_donation_received (fund_id, donor_name, donor_email, method, card_no, amount, acc_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssii", $fund_id, $donor_name, $donor_email, $pay, $card_no, $received_amount, $acc_id);
            if ($stmt->execute()) {
                $content = "Fund Received: $received_amount Tk from $donor_name via card banking.";
                $stmt_notifications = $con->prepare("INSERT INTO notifications (org_id, content) VALUES (?, ?)");
                $stmt_notifications->bind_param("is", $org_id, $content);
                $stmt_notifications->execute();
                
                $query = "SELECT amount, received FROM funds WHERE fund_id = ?";
                $stmt2 = $con->prepare($query);
                $stmt2->bind_param("i", $fund_id);
                $stmt2->execute();
                $fund = $stmt2->get_result()->fetch_assoc();
                $Target_amount = $fund['amount'];
                $current_amount = $fund['received'];
                $new_current_amount = $current_amount + $received_amount;

                if($new_current_amount >= $Target_amount){
                    $update_query = "UPDATE funds SET received = ?, completed = 1 WHERE fund_id = ?";
                } else {
                    $update_query = "UPDATE funds SET received = ? WHERE fund_id = ?";
                }
                $update_stmt = $con->prepare($update_query);
                $update_stmt->bind_param("di", $new_current_amount, $fund_id);
                $update_stmt->execute();

                $_SESSION['positive'] = "Fund donated successfully.";
                header('Location: ./O_home.php');
                exit(0);
            } else {
                echo "Error in card donation: " . $stmt->error;
            }
        } else {
            $bkash_no = $_POST['bkash_no'];
            $stmt = $con->prepare("INSERT INTO fund_donation_received (fund_id, donor_name, donor_email, method, bkash_no, amount, acc_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("issssii", $fund_id, $donor_name, $donor_email, $pay, $bkash_no, $received_amount, $acc_id);
            if ($stmt->execute()) {
                $content = "Fund Received: $received_amount Tk from $donor_name via Bkash.";
                $stmt_notifications = $con->prepare("INSERT INTO notifications (org_id, content) VALUES (?, ?)");
                $stmt_notifications->bind_param("is", $org_id, $content);
                $stmt_notifications->execute();

                $query = "SELECT amount, received FROM funds WHERE fund_id = ?";
                $stmt2 = $con->prepare($query);
                $stmt2->bind_param("i", $fund_id);
                $stmt2->execute();
                $fund = $stmt2->get_result()->fetch_assoc();
                $Target_amount = $fund['amount'];
                $current_amount = $fund['received'];
                $new_current_amount = $current_amount + $received_amount;

                if($new_current_amount >= $Target_amount){
                    $update_query = "UPDATE funds SET received = ?, completed = 1 WHERE fund_id = ?";
                } else {
                    $update_query = "UPDATE funds SET received = ? WHERE fund_id = ?";
                }
                $update_stmt = $con->prepare($update_query);
                $update_stmt->bind_param("di", $new_current_amount, $fund_id);
                $update_stmt->execute();


                $_SESSION['positive'] = "Fund donated successfully.";
                header('Location: ./O_home.php');
                exit(0);
            } else {
                echo "Error in Bkash donation: " . $stmt->error;
            }
        }
    } else {
        echo "Error";
    }
?>
