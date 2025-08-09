<?php
require_once '../config.php';

// Check if user is admin
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

// Get all images
$sql = "SELECT images.*, users.username 
        FROM images 
        JOIN users ON images.uploaded_by = users.id 
        ORDER BY uploaded_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard - Woogle</title>
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="container-admin">
        <div class="back-link">
            <a href="../index.php"><i class="fa-solid fa-arrow-left"></i>Back to search</a>
        </div>
        <div class="intro">
            <h1>Admin Dashboard</h1>
            <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?> (Admin)</p>

            <nav>
                <a href="upload.php">Upload New Image</a> |
                <a href="../logout.php">Logout</a>
            </nav>
        </div>

        <h2>All Uploaded Images</h2>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="image-admin">
                <?php while ($image = mysqli_fetch_assoc($result)): ?>
                    <div class="image-item">
                        <a href="../view.php?id=<?php echo $image['id']; ?>">
                            <img src="../images/uploads/<?php echo htmlspecialchars($image['filename']); ?>"
                                alt="<?php echo htmlspecialchars($image['caption']); ?>">

                        </a>
                        <div class="details">
                            <p><?php echo htmlspecialchars($image['caption']); ?></p>
                            <small>
                                Uploaded by: <?php echo htmlspecialchars($image['username']); ?><br>
                                Date: <?php echo date('Y-m-d H:i', strtotime($image['uploaded_at'])); ?>
                            </small>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No images uploaded yet.</p>
        <?php endif; ?>
    </div>
</body>

</html>