<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php';?>
    <?php include 'user_info.php';?>
    <main>
        <h1>Admin Dashboard</h1>
        <a href="add-sales.php" class="link">Add Sales Staff</a>
        <br>
        <a href="view-messages.php" class="link">View Messages</a>
    </main>
    <?php include 'footer.php';?>
</body>
</html>
