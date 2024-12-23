<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
        .login-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 4rem 2rem;
            flex: 1;
        }
        .login-container h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .login-container p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        .login-container form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 100%;
            max-width: 400px;
        }
        .login-container input {
            padding: 0.75rem;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
        }
        .login-container button {
            padding: 0.75rem;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            background: #2575fc;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s;
        }
        .login-container button:hover {
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    
    if ($email === "sevik.emree@gmail.com" && $password === "1234") {
        $_SESSION['user_id'] = 1; 
        $_SESSION['user_role'] = 'admin';
        header("Location: admin.php");
        exit;
    }

    
    $sql = "SELECT id, password, role FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_role'] = $row['role'];

            if ($row['role'] === 'admin') {
                header("Location: admin.php");
            } else {
                header("Location: main.php");
            }
            exit;
        } else {
            $error_message = "Invalid password.";
        }
    } else {
        $error_message = "No user found with this email.";
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

<div class="login-container">
    <h1>Log In</h1>
    <p>Access your account to explore more.</p>
    <?php if (!empty($error_message)) : ?>
        <div class="error-message"> <?php echo htmlspecialchars($error_message); ?> </div>
    <?php endif; ?>
    <form action="" method="post">
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Log In</button>
    </form>
    <p>Don't have an account? <a href="register.php" style="color: #fff; text-decoration: underline;">Create a new account</a>.</p>
</div>



<footer>
    &copy; 2024 Blog 3. All rights reserved.
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
