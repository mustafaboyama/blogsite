<?php
session_start();


if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}


if (isset($_GET['logout'])) {
    session_destroy(); // End session
    header("Location: index.php");
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


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $user_id = (int)$_POST['user_id'];
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->close();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $user_id = (int)$_POST['user_id'];
    $new_role = $_POST['role'];
    $stmt = $conn->prepare("UPDATE users SET role = ? WHERE id = ?");
    $stmt->bind_param("si", $new_role, $user_id);
    $stmt->execute();
    $stmt->close();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_blog'])) {
    $blog_id = (int)$_POST['blog_id'];
    $stmt = $conn->prepare("DELETE FROM blogs WHERE id = ?");
    $stmt->bind_param("i", $blog_id);
    $stmt->execute();
    $stmt->close();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_blog'])) {
    $blog_id = (int)$_POST['blog_id'];
    $new_title = $_POST['title'];
    $new_content = $_POST['content'];
    $stmt = $conn->prepare("UPDATE blogs SET title = ?, content = ? WHERE id = ?");
    $stmt->bind_param("ssi", $new_title, $new_content, $blog_id);
    $stmt->execute();
    $stmt->close();
}


$users = $conn->query("SELECT id, email, role FROM users");
$blogs = $conn->query("SELECT blogs.id, blogs.title, blogs.content, users.email AS author_email FROM blogs JOIN users ON blogs.user_id = users.id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
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
        h1 {
            text-align: center;
            margin: 2rem 0;
            font-size: 2.5rem;
        }
        .table-container {
            margin: 2rem auto;
            max-width: 90%;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2rem;
        }
        table th, table td {
            padding: 0.8rem;
            text-align: left;
        }
        table th {
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
        }
        table tr:nth-child(even) {
            background: rgba(255, 255, 255, 0.1);
        }
        table tr:hover {
            background: rgba(255, 255, 255, 0.2);
        }
        .btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
            background: #2575fc;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #6a11cb;
        }
        footer {
            text-align: center;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.8);
            margin-top: auto;
        }
    </style>
</head>
<body>
<nav>
    <a href="index.php" class="logo">BLOG 3</a>
    <ul>
        <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="?logout=true"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
    </ul>
</nav>
<h1>Admin Panel</h1>

<div class="table-container">
    <h2>Users</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = $users->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($user['id']) ?></td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['role']) ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <button type="submit" name="delete_user" class="btn"><i class="fas fa-trash"></i></button>
                        </form>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <select name="role" required>
                                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                            </select>
                            <button type="submit" name="update_user" class="btn"><i class="fas fa-edit"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h2>Blogs</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Author</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($blog = $blogs->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($blog['id']) ?></td>
                    <td><?= htmlspecialchars($blog['title']) ?></td>
                    <td><?= htmlspecialchars($blog['content']) ?></td>
                    <td><?= htmlspecialchars($blog['author_email']) ?></td>
                    <td>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="blog_id" value="<?= $blog['id'] ?>">
                            <button type="submit" name="delete_blog" class="btn"><i class="fas fa-trash"></i></button>
                        </form>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="blog_id" value="<?= $blog['id'] ?>">
                            <input type="text" name="title" value="<?= htmlspecialchars($blog['title']) ?>" required>
                            <input type="text" name="content" value="<?= htmlspecialchars($blog['content']) ?>" required>
                            <button type="submit" name="update_blog" class="btn"><i class="fas fa-edit"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<footer>
    &copy; 2024 Admin Panel. All rights reserved.
</footer>
</body>
</html>

<?php
$conn->close();
?>
