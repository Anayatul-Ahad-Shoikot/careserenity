<?php
include './db_con.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update'])) {
        $fund_id = $_POST['fund_id'];
        $name = $_POST['name'];
        $duration = $_POST['duration'];
        $img = $_FILES['img']['name'];
        
        if ($img) {
            move_uploaded_file($_FILES['img']['tmp_name'], "./assets/" . $img);
            $update_query = "UPDATE funds SET img = ? WHERE fund_id = ?";
            $stmt = $con->prepare($update_query);
            $stmt->bind_param('si',$img, $fund_id);
            $stmt->execute();
            $_SESSION['positive'] = "Fund image updated successfully.";
            $stmt->close();
            header(`Location: ./O_fund_details.php?fund_id={$fund_id}`);
        } 

        if($name) {
            $update_query = "UPDATE funds SET name = ? WHERE fund_id = ?";
            $stmt = $con->prepare($update_query);
            $stmt->bind_param('si', $name, $fund_id);
            $stmt->execute();
            $_SESSION['positive'] = "Fund Name updated successfully.";
            $stmt->close();
            header(`Location: ./O_fund_details.php?fund_id={$fund_id}`);
        }

        if($duration) {
            $update_query = "UPDATE funds SET duration = ? WHERE fund_id = ?";
            $stmt = $con->prepare($update_query);
            $stmt->bind_param('si', $duration, $fund_id);
            $stmt->execute();
            $_SESSION['positive'] = "Date modified successfully.";
            $stmt->close();
            header(`Location: ./O_fund_details.php?fund_id={$fund_id}`);
        }


    } elseif (isset($_POST['delete'])) {
        $delete_query = "DELETE FROM funds WHERE fund_id = ?";
        $stmt = $con->prepare($delete_query);
        $stmt->bind_param('i', $fund_id);

        if ($stmt->execute()) {
            $_SESSION['positive'] = "Fund has been deleted !";
            $stmt->close();
            header('Location: ./O_funds.php');
        } else {
            $_SESSION['negative'] =  "Failed to delete selected fund !";
            $stmt->close();
            header('Location: ./O_funds.php');
        }
    }
}
