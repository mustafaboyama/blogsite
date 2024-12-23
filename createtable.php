<?php

$link_db = mysqli_connect("localhost", "root", "", "Blog");
if ($link_db == false) {
    die("Error: " . mysqli_connect_error() . "<br>");
}
echo "Connected successfully: " . mysqli_get_host_info($link_db) . "<br>";


$sql_users = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user'
)";
if (mysqli_query($link_db, $sql_users)) {
    echo "Table 'users' created successfully.<br>";
} else {
    echo "Error creating 'users' table: " . mysqli_error($link_db) . "<br>";
}


$sql_blogs = "CREATE TABLE IF NOT EXISTS blogs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)";
if (mysqli_query($link_db, $sql_blogs)) {
    echo "Table 'blogs' created successfully.<br>";
} else {
    echo "Error creating 'blogs' table: " . mysqli_error($link_db) . "<br>";
}


mysqli_close($link_db);
?>
