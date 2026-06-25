<?php
require_once "../includes/session.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'lecturer') {
    header("location: ../login.php");
    exit();
}
?>

<h1>Lecturer Dashboard</h1>

<p>Welcome <?php echo $_SESSION['fullname']; ?></p>

<hr>

<a href="create_assignment.php">Create Assignment</a><br><br>
<a href="view_assignment.php">View Assignment</a><br><br>
<a href="../logout.php">Logout</a>