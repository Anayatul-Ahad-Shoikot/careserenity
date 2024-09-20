<?php
    include("./db_con.php");
    session_start();

    if(isset($_GET['id'])){
        $seminar_id = $_GET['id'];

        $query = "SELECT * FROM seminars WHERE seminar_id = $seminar_id";
        $result = mysqli_query($con, $query);
        $seminar = mysqli_fetch_assoc($result);

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $title = $_POST['title'];
            $description = $_POST['description'];
            $date = $_POST['date'];

            $updateQuery = "UPDATE seminars SET title = '$title', description = '$description', date = '$date' WHERE seminar_id = $seminar_id";
            mysqli_query($con, $updateQuery);

            header('Location: O_seminar.php');
            exit;
        }
    }
    else{
        echo "Invalid seminar ID.";
    }
?>

<form action="" method="POST">
    <input type="text" name="title" value="<?php echo htmlspecialchars($seminar['title']); ?>" required>
    <textarea name="description"><?php echo htmlspecialchars($seminar['description']); ?></textarea>
    <input type="date" name="date" value="<?php echo htmlspecialchars($seminar['date']); ?>" required>
    <button type="submit">Save Changes</button>
</form>