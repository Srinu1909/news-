<?php
include 'includes/db.php';

// Fetch posts
$query = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Platform</title>

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

        /* Post Card styling */
        .post-card {
            display: flex;
            flex-wrap: wrap;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            background-color: #fff;
            transition: transform 0.3s ease;
        }

        .post-card:hover {
            transform: translateY(-5px);
        }

        .post-card img {
            max-width: 200px;
            height: auto;
            border-radius: 8px;
            margin-right: 20px;
            flex-shrink: 0;
        }

        .post-content {
            flex-grow: 1;
            padding: 10px;
        }

        .post-content h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }

        .post-content p {
            font-size: 16px;
            line-height: 1.6;
            color: #555;
        }

        .post-content a {
            text-decoration: none;
            color: #007BFF;
            margin-right: 10px;
        }

        .post-content a:hover {
            text-decoration: underline;
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

        /* Responsiveness */
        @media (max-width: 768px) {
            .post-card {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .post-card img {
                max-width: 100%;
                margin-bottom: 20px;
            }
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
        <h1>Latest News</h1>

        <?php foreach ($posts as $post): ?>
            <div class="post-card">
                <!-- Post Image -->
                <img src="assets/images/<?= $post['image'] ?>" alt="<?= $post['title'] ?>">

                <!-- Post Content -->
                <div class="post-content">
                    <h2><a href="post.php?id=<?= $post['post_id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h2>
                    <p><?= substr($post['content'], 0, 150) ?>...</p>
                    <p>
                        <a href="edit.php?id=<?= $post['post_id'] ?>">Edit</a> | 
                        <a href="delete.php?id=<?= $post['post_id'] ?>">Delete</a>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>

        <a href="create.php">Create New Post</a>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 News Platform. All rights reserved.</p>
    </footer>
</body>
</html>
