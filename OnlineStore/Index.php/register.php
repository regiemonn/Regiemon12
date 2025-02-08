<?php
// File to store user data
$file = "users.txt";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    // Check if fields are empty
    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required!";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Check if username already exists
        $users = file_exists($file) ? file($file, FILE_IGNORE_NEW_LINES) : [];
        foreach ($users as $user) {
            $user_details = explode(":", $user);
            if ($user_details[0] == $username) {
                $error = "Username already exists!";
                break;
            }
        }

        // If no errors, save the user
        if (!isset($error)) {
            $new_user = $username . ":" . password_hash($password, PASSWORD_DEFAULT) . "\n";
            file_put_contents($file, $new_user, FILE_APPEND);
            $success = "Account created successfully! <a href='index.php'>Log in</a>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account</title>
</head>
<body>
    <h2>Create Account</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        <button type="submit">Create Account</button>
    </form>
    <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
    <?php if (isset($success)) { echo "<p style='color:green;'>$success</p>"; } ?>
    <br>
    <a href="index.php">Back to Login</a>
</body>
</html>
