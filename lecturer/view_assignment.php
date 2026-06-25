<?php
require_once __DIR__ . "/../includes/session.php";
require_once __DIR__ . "/../includes/db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$result = mysqli_query(
    $conn,
    "SELECT * FROM assignments ORDER BY due_date"
);

?>

<h1>All Assignments</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Due Date</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><?php echo $row['due_date']; ?></td>
        </tr>
    <?php } ?>
</table>

<br>

<a href="dashboard.php">Back</a>