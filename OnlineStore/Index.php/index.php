<?php
session_start();


$file = "users.txt";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    $users = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];
    foreach ($users as $user) {
        $user_details = explode(":", $user);
        if ($user_details[0] == $username && password_verify($password, $user_details[1])) {
            $_SESSION["loggedin"] = true;
            header("Location: home.php");
            exit;
        }
    }

    $error = "Invalid username or password!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit">Login</button>
        </form>
        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        <br>
        <a href="register.php">Create Account</a>
    </div>
</body>
</html>

