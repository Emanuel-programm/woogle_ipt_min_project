<?php require_once 'config.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Woogle Image Search</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>


    <div class="header">
        <nav class="navbar">
            <?php if (isset($_SESSION['user_id'])): ?>
                <h3>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!
                    <a href="logout.php">Logout</a>

                    | <a href="admin/dashboard.php">Admin Panel</a>

                </h3>
            <?php else: ?>
                <h3>Do You want to be able upload your own Images <a href="login.php">Login</a> OR <a href="register.php">Register</a></h3>
            <?php endif; ?>

        </nav>
    </div>

    <div class="container">
        <h1>Woogle</h1>
        <form action="search.php" method="get">
            <input type="text" name="q" placeholder="Search images..." required>
            <button type="submit">Search</button>
        </form>


    </div>
</body>

</html>