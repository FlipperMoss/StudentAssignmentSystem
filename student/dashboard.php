<?php
require_once __DIR__ . "/../includes/session.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("location: ../login.php");
    exit();
}
?>

<h1>Student Dashboard</h1>

<p>Welcome <?php echo $_SESSION['fullname']; ?></p>

<hr>
<a href="view_assignment.php">View Assignment</a><br><br>
<a href="../logout.php">Logout</a>