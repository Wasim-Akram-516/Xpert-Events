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
    <title>Add Sales Staff</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php';?>
    <main>
        <h1>Add Sales Staff</h1>
        <form action="add-sales-process.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <input type="submit" value="Add Sales Staff">
        </form>
    </main>
    <?php include 'footer.php';?>
</body>
</html>
