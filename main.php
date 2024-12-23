<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Blog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_post'])) {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $user_id = $_SESSION['user_id'];

    $sql = "INSERT INTO blogs (user_id, title, content, created_at) VALUES ('$user_id', '$title', '$content', NOW())";

    if ($conn->query($sql) === TRUE) {
        echo "<p>New post added successfully!</p>";
    } else {
        echo "<p>Error: " . $conn->error . "</p>";
    }
}


$sql = "SELECT blogs.id, blogs.title, blogs.content, blogs.created_at, users.email FROM blogs JOIN users ON blogs.user_id = users.id ORDER BY blogs.created_at DESC LIMIT 5";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
            background: rgba(0, 0, 0, 0.8);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
        nav .logo {
            font-size: 1.8rem;
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
        .post-form {
            margin: 2rem auto;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            max-width: 600px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .post-form h2 {
            text-align: center;
            margin-bottom: 1rem;
        }
        .post-form label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 1rem;
            color: #fff;
        }
        .post-form input,
        .post-form textarea {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
        }
        .post-form button {
            width: 100%;
            padding: 0.8rem;
            font-size: 1.2rem;
            border: none;
            border-radius: 5px;
            background: #2575fc;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s;
        }
        .post-form button:hover {
            background: #6a11cb;
        }
        .recent-posts {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .recent-posts h2 {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .post {
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 5px;
        }
        .post h3 {
            margin: 0 0 0.5rem;
            font-size: 1.5rem;
            color: #fff;
        }
        .post p {
            margin: 0 0 0.5rem;
            font-size: 1.2rem;
            color: #ddd;
        }
        .post small {
            font-size: 0.9rem;
            color: #aaa;
        }
        .success-message {
            color: #28a745;
            text-align: center;
        }
        .error-message {
            color: #dc3545;
            text-align: center;
        }
        footer {
            text-align: center;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
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
    <li><a href="?logout=true"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
    </ul>
</nav>

<div class="post-form">
    <h2>Add New Post</h2>
    <form action="" method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>
        <label for="content">Content:</label>
        <textarea id="content" name="content" rows="5" required></textarea>
        <button type="submit" name="new_post">Add</button>
    </form>
</div>

<div class="recent-posts">
    <h2>Recent Posts</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='post'>";
            echo "<h3>" . htmlspecialchars($row['title']) . "</h3>";
            echo "<p>" . nl2br(htmlspecialchars($row['content'])) . "</p>";
            echo "<small>By: " . htmlspecialchars($row['email']) . " on " . htmlspecialchars($row['created_at']) . "</small>";
            echo "</div>";
        }
    } else {
        echo "<p>No posts available yet.</p>";
    }
    ?>
</div>

<footer>
    &copy; 2024 Blog Page. All rights reserved.
</footer>
</body>
</html>

<?php
$conn->close();
?>
