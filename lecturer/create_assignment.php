<?php

require_once "../includes/session.php";
require_once "../includes/db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'lecturer') {
    header("Location: ../login.php");
    exit();
}

$message = "";

if (isset($_POST['create'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $due_date = $_POST['due_date'];

    $lecturer_id = $_SESSION['user_id'];

    $sql = "INSERT INTO assignments (title, description, due_date, lecturer_id)
                VALUES ('$title', '$description', '$due_date', '$lecturer_id')";

    if (isset($conn) && mysqli_query($conn, $sql)) {
        $message = "Assignment created successfully.";
    } else {
        $message = "Unable to create assignment. Database connection unavailable.";
    }
}

?>

<h1>Create Assignment</h1>

<p><?php echo $message; ?></p>

<form method="POST">
    Title: <br>
    <input type="text" name="title" required><br><br>

    Description:<br>
    <textarea name="description" rows="5"></textarea><br><br>

    Due Date: <br>
    <input type="date" name="due_date" required><br><br>

    <button type="submit" name="create">
        Create Assignment
    </button>
</form>

<br>

<a href="dashboard.php">Back</a>