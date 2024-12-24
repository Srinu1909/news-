<?php
include 'includes/db.php';

// Fetch all comments
$query = $pdo->query("SELECT comments.comment_id, posts.title AS post_title, comments.name, comments.comment, comments.created_at FROM comments JOIN posts ON comments.post_id = posts.post_id ORDER BY comments.created_at DESC");
$comments = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Comments</title>
</head>
<body>
    <h1>All Comments</h1>
    <p>Below are all the comments posted on the platform:</p>

    <?php foreach ($comments as $comment): ?>
        <div>
            <h3><a href="post.php?id=<?= $comment['post_id'] ?>"><?= htmlspecialchars($comment['post_title']) ?></a></h3>
            <p><strong><?= htmlspecialchars($comment['name']) ?></strong> commented on <?= $comment['created_at'] ?>:</p>
            <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
            <hr>
        </div>
    <?php endforeach; ?>

    <a href="index.php">Back to Home</a>
</body>
</html>
