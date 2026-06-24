<?php
require_once "includes/db.php";

$message = "";

if (isset($_POST['register'])) {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $role = $_POST['role'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = mysqli_prepare($conn, "INSERT INTO users(fullname, email, password, role) VALUES(?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $fullname, $email, $hashedPassword, $role);

    if (mysqli_stmt_execute($stmt)) {
        $message = "Registration successful!";
    } else {
        $message = "Error: " . mysqli_error($conn);
    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <h2>Register User</h2>

    <p><?php echo $message; ?></p>

    <form method="POST">
        <label>Full Name:</label> <br>
        <input type="text" name="fullname" required> <br><br>

        <label>Email:</label> <br>
        <input type="email" name="email" required> <br><br>

        <label>Password:</label> <br>
        <input type="password" name="password" required> <br><br>

        <label>Role:</label> <br>
        <select name="role">
            <option value="student">Student</option>
            <option value="lecturer">Lecturer</option>
        </select> <br><br>

        <button type="submit" name="register">
            Register
        </button>
    </form>
</body>

</html>