<?php
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];
    
    // Image Upload
    move_uploaded_file($_FILES['image']['tmp_name'], 'assets/images/' . $image);

    // Insert data into database
    $stmt = $pdo->prepare("INSERT INTO posts (title, content, image) VALUES (?, ?, ?)");
    $stmt->execute([$title, $content, $image]);

    // Redirect to index page after creating a post
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>

    <style>
        /* General page styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        /* Navbar styling */
        nav {
            background-color: #333;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            margin: 0 10px;
        }

        nav a:hover {
            background-color: #575757;
            border-radius: 4px;
        }

        /* Main content area styling */
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input[type="text"], textarea, input[type="file"], button {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="text"], textarea {
            width: 90%;
        }

        textarea {
            resize: vertical;
            height: 150px;
        }

        button {
            background-color: #333;
            color: white;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #575757;
        }

        /* Footer styling */
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav>
        <a href="index.php">Home</a>
        <a href="create.php">Create Post</a>
        <a href="about.php">About</a>
        <a href="login.php">Login</a>
    </nav>

    <!-- Main content -->
    <div class="container">
        <h1>Create a New Post</h1>

        <form method="POST" enctype="multipart/form-data">
            <input type="text" name="title" placeholder="Post Title" required><br>
            <textarea name="content" placeholder="Post Content" required></textarea><br>
            <input type="file" name="image" required><br>
            <button type="submit">Create Post</button>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 News Platform. All rights reserved.</p>
    </footer>

</body>
</html>
