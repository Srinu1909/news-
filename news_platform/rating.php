<?php
include 'includes/db.php';

// Fetch ratings for all posts
$query = $pdo->query("SELECT posts.title, AVG(ratings.rating) AS avg_rating FROM posts LEFT JOIN ratings ON posts.post_id = ratings.post_id GROUP BY posts.post_id ORDER BY avg_rating DESC");
$ratings = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Ratings</title>
</head>
<body>
    <h1>Post Ratings</h1>
    <p>Here are the average ratings for all posts on the platform:</p>

    <?php foreach ($ratings as $rating): ?>
        <div>
            <h2><?= htmlspecialchars($rating['title']) ?></h2>
            <p>Average Rating: <?= round($rating['avg_rating'], 1) ?> / 5</p>
        </div>
    <?php endforeach; ?>

    <a href="index.php">Back to Home</a>
</body>
</html>
