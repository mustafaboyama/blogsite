<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
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
        .contact-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        .contact-container h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        .contact-container p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            text-align: center;
        }
        .contact-form {
            background: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 10px;
            max-width: 500px;
            width: 100%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }
        .contact-form label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 1rem;
            color: #fff;
        }
        .contact-form input,
        .contact-form textarea {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
        }
        .contact-form input {
            height: 40px;
        }
        .contact-form textarea {
            resize: none;
            height: 100px;
        }
        .contact-form button {
            padding: 0.8rem 2rem;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            background: #2575fc;
            color: #fff;
            cursor: pointer;
            transition: background 0.3s;
        }
        .contact-form button:hover {
            background: #6a11cb;
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

<div class="contact-container">
    <h1>Contact Us</h1>
    <p>Feel free to reach out to us via the form below.</p>
    <form class="contact-form" action="submit_contact.php" method="post">
        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email address" required>

        <label for="message">Message</label>
        <textarea id="message" name="message" placeholder="Type your message here..." required></textarea>

        <button type="submit">Send Message</button>
    </form>
</div>

<footer>
    &copy; 2024 Blog 3. All rights reserved.
</footer>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
