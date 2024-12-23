<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
        }
        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            background: rgba(0, 0, 0, 0.6);
        }
        nav .logo {
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
            color: #fff;
        }
        nav ul {
            list-style: none;
            display: flex;
            gap: 1rem;
        }
        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .register-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 4rem 2rem;
            flex: 1;
        }
        .register-container h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .register-container p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        .register-container form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 100%;
            max-width: 400px;
        }
        .register-container input {
            padding: 0.75rem;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
        }
        .register-container button {
            padding: 0.75rem;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            background: #2575fc;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s;
        }
        .register-container button:hover {
            background: #6a11cb;
        }
        .error-message {
            background: rgba(255, 0, 0, 0.7);
            padding: 0.5rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            color: #fff;
        }
        footer {
            text-align: center;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.6);
            margin-top: auto;
        }
    </style>
</head>
<body>
<?php
session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Blog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

    if ($password !== $confirm_password) {
        $error_message = "Passwords do not match!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $role = 'user'; // Default role

        // Kullanıcıyı ekleme SQL sorgusu
        $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$hashed_password', '$role')";

        if ($conn->query($sql) === TRUE) {
            $success_message = "Registration successful. You can now log in!";
            header("Location: login.php");
            exit;
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}
?>
<nav>
    <a href="index.php" class="logo">BLOG 3</a>
    <ul>
        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="contact.php"><i class="fas fa-phone"></i> Contact</a></li>
    </ul>
</nav>

<div class="register-container">
    <h1>Register</h1>
    <p>Create your account to join the platform!</p>
    <?php if (!empty($error_message)) : ?>
        <div class="error-message"> <?php echo htmlspecialchars($error_message); ?> </div>
    <?php endif; ?>
    <form action="" method="post">
    <input type="text" name="username" placeholder="User Name" required>
    <input type="email" name="email" placeholder="Email Address" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    <button type="submit">Register</button>
</form>
</div>

<footer>
    &copy; 2024 Blog 3. All rights reserved.
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
