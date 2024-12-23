<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG 3</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
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
        .hero {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 4rem 2rem;
            flex: 1;
        }
        .hero h1 {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        .button-group {
            display: flex;
            gap: 1rem;
        }
        .button {
            padding: 0.7rem 2rem;
            font-size: 1.2rem;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            background: #2575fc;
            color: #fff;
            transition: background 0.3s;
        }
        .button:hover {
            background: #6a11cb;
        }
        .admin-button {
            background: #008000;
        }
        .admin-button:hover {
            background: #0f4d0f;
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
<nav>
    <a href="index.php" class="logo">BLOG 3</a>
    <ul>
        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="contact.php"><i class="fas fa-phone"></i> Contact</a></li>
    </ul>
</nav>

<div class="hero" id="home">
    <h1>Share your thoughts with everyone!</h1>
    <p>Welcome to the thought sharing platform!</p>
    <div class="button-group">
        <a href="login.php" class="button admin-button">Admin Login</a>
        <a href="login.php" class="button">User Login</a>
    </div>
</div>
<footer>
    &copy; 2024 Blog 3. All rights reserved.
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
