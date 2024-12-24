<?php
include 'includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Fetch post
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE post_id = ?");
    $stmt->execute([$id]);
    $post = $stmt->fetch();

    // Fetch comments
    $stmt_comments = $pdo->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC");
    $stmt_comments->execute([$id]);
    $comments = $stmt_comments->fetchAll();

    // Fetch ratings
    $stmt_ratings = $pdo->prepare("SELECT AVG(rating) AS avg_rating FROM ratings WHERE post_id = ?");
    $stmt_ratings->execute([$id]);
    $rating = $stmt_ratings->fetch();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['comment'])) {
        // Add comment
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        $stmt = $pdo->prepare("INSERT INTO comments (post_id, name, comment) VALUES (?, ?, ?)");
        $stmt->execute([$id, $name, $comment]);
    } elseif (isset($_POST['rating'])) {
        // Add rating
        $rating = $_POST['rating'];
        $stmt = $pdo->prepare("INSERT INTO ratings (post_id, rating) VALUES (?, ?)");
        $stmt->execute([$id, $rating]);
    }

    header("Location: post.php?id=$id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($post['title']) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($post['title']) ?></h1>
    <img src="assets/images/<?= $post['image'] ?>" alt="<?= $post['title'] ?>" width="300">
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>

    <h2>Average Rating: <?= round($rating['avg_rating'], 1) ?></h2>

    <!-- Rating Form -->
    <form method="POST">
        <label>Rate this post (1-5):</label>
        <input type="number" name="rating" min="1" max="5" required>
        <button type="submit">Submit Rating</button>
    </form>

    <h2>Comments</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Your name" required><br>
        <textarea name="comment" placeholder="Your comment" required></textarea><br>
        <button type="submit">Submit Comment</button>
    </form>

    <?php foreach ($comments as $comment): ?>
        <div>
            <p><strong><?= htmlspecialchars($comment['name']) ?>:</strong> <?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
        </div>
    <?php endforeach; ?>
</body>
</html>
