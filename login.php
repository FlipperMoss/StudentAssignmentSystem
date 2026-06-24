<?php
require_once "includes/session.php";
require_once "includes/db.php";

$message = "";

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        $storedPassword = $user['password'];
        if (str_starts_with($storedPassword, '$$')) {
            $storedPassword = substr($storedPassword, 1);
        }

        if (password_verify($password, $storedPassword)) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] == 'student') {
                header("Location: student/dashboard.php");
            } else {
                header("Location: lecturer/dashboard.php");
            }

            exit();
        }
    }

    mysqli_stmt_close($stmt);

    $message = "Invalid email or password";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <h2>Login</h2>

    <p><?php echo $message; ?></p>

    <form method="POST">
        <label>Email:</label> <br>
        <input type="email" name="email" required> <br><br>

        <label>Password:</label> <br>
        <input type="password" name="password" required> <br><br>

        <button type="submit" name="login">
            Login
        </button>
    </form>
</body>

</html>