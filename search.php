<?php
require_once 'config.php';

$query = isset($_GET['q']) ? clean_input($_GET['q']) : '';

$sql = "SELECT * FROM images WHERE caption LIKE '%$query%'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Search Results - Woogle</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="back-link">
        <a href="index.php"><i class="fa-solid fa-arrow-left"></i>Back to search</a>
    </div>
    <div class="container">
        <h1>Search Results for "<?php echo htmlspecialchars($query); ?>"</h1>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="image-gallery">
                <?php while ($image = mysqli_fetch_assoc($result)): ?>
                    <div class="image-item">
                        <a href="view.php?id=<?php echo $image['id']; ?>">
                            <img src="images/uploads/<?php echo htmlspecialchars($image['filename']); ?>"
                                alt="<?php echo htmlspecialchars($image['caption']); ?>">
                        </a>
                        <p><?php echo htmlspecialchars($image['caption']); ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No images found matching your search.</p>
        <?php endif; ?>


    </div>


</body>

</html>