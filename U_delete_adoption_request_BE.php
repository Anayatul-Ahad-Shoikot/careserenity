<?php
include './db_con.php';
if (isset($_GET['adoption_id'])) {
    $adoption_id = (int) $_GET['adoption_id'];
    $stmt = $con->prepare("DELETE FROM adoptions WHERE adoption_id = ?");
    $stmt->bind_param("i", $adoption_id);
    if ($stmt->execute()) {
        $_SESSION['positive'] = "Adoption request cancelled.";
    } else {
        $_SESSION['negative'] = "Error in cancelation.";
    }
    $stmt->close();
    $con->close();
    header('Location: ./U_profile.php');
} else {
    echo "adoption_id not provided.";
}
?>
