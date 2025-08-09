<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$image_id = (int)$_GET['id'];
$sql = "SELECT images.*, users.username 
        FROM images 
        JOIN users ON images.uploaded_by = users.id 
        WHERE images.id = $image_id";
$result = mysqli_query($conn, $sql);
$image = mysqli_fetch_assoc($result);

if (!$image) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title><?php echo htmlspecialchars($image['caption']); ?> - Woogle</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="back-link">
        <a href="search.php"><i class="fa-solid fa-arrow-left"></i>Back to search</a>
    </div>

    <div class="container-view">
        <h1><?php echo htmlspecialchars($image['caption']); ?></h1>
        <div class="image-view">
            <img src="images/uploads/<?php echo htmlspecialchars($image['filename']); ?>"
                alt="<?php echo htmlspecialchars($image['caption']); ?>">
            <div class="image-info">
                <p><strong>Uploaded:</strong> <?php echo date('Y-m-d H:i:s', strtotime($image['uploaded_at'])); ?></p>
                <p><strong>Uploaded By:</strong> <?php echo htmlspecialchars($image['username']); ?></p>
            </div>
        </div>

        <?php if (!isset($_SESSION['user_id'])): ?>
            <div class="upload-prompt">
                <p>Want to share your own images?</p>
                <a href="register.php" class="register-btn">Register Now</a>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>