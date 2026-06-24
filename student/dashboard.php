<?php
require_once "../includes/session.php";

if (!isset($_SESSION['user_id'])) {
    header("location: ../login.php");
    exit();
}
?>

<h1>Student Dashboard</h1>

<p>Welcome <?php echo $_SESSION['fullname']; ?></p>