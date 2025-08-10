<?php
require_once '../config.php';

// Simple admin check
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $caption = clean_input($_POST['caption']);
    $user_id = $_SESSION['user_id'];

    // File upload handling
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = '../images/uploads/';
        $filename = uniqid() . '_' . basename($_FILES['image']['name']);
        $target_file = $upload_dir . $filename;

        // Check if file is an image
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $sql = "INSERT INTO images (filename, caption, uploaded_by) 
                        VALUES ('$filename', '$caption', $user_id)";

                if (mysqli_query($conn, $sql)) {
                    $message = '<div class="success">Image uploaded successfully!</div>';
                    header("Location: dashboard.php");
                    exit();
                } else {
                    $message =   '<div class="error">Error: ' . mysqli_error($conn) . '</div>';
                }
            } else {
                $message = '<div class="error">Error uploading file.</div>';
            }
        } else {
            $message = '<div class="error">File is not an image.</div>';
        }
    } else {
        $message = '<div class="error">Please select an image.</div>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Upload Image - Woogle Admin</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <div class="container">
        <h1>Upload Image</h1>

        <nav>
            <a href="dashboard.php">Dashboard</a> |
            <a href="../logout.php">Logout</a>
        </nav>

        <?php echo $message; ?>

        <form method="post" enctype="multipart/form-data">
            <div>
                <label>Choose Image:</label>
                <input type="file" name="image" accept="image/*" required>
            </div>
            <div>
                <label>Image Caption:</label>
                <input type="text" name="caption" required>
            </div>
            <button type="submit">Upload</button>
        </form>
    </div>
</body>

</html>