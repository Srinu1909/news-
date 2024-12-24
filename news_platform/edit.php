<?php
include 'includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE post_id = ?");
    $stmt->execute([$id]);
    $post = $stmt->fetch();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image = $_FILES['image']['name'];
    
    // Image Upload
    if ($image) {
        move_uploaded_file($_FILES['image']['tmp_name'], 'assets/images/' . $image);
        $imageQuery = ", image = '$image'";
    } else {
        $imageQuery = "";
    }

    $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? $imageQuery WHERE post_id = ?");
    $stmt->execute([$title, $content, $id]);

    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required><br>
        <textarea name="content" required><?= htmlspecialchars($post['content']) ?></textarea><br>
        <input type="file" name="image"><br>
        <button type="submit">Update Post</button>
    </form>
</body>
</html>
