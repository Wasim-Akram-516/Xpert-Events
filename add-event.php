<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xpert Events - Add Event</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'sales') {
    header("Location: login.php");
    exit;
}
?>
<?php include 'header.php';?>
<?php include 'user_info.php';?>
<main>
    <h1>Add Event</h1>
    <form action="add-event-process.php" method="post" enctype="multipart/form-data">
        <label for="title">Event Title:</label>
        <input type="text" name="title" id="title" required>

        <label for="description">Event Description:</label>
        <textarea name="description" id="description" required></textarea>

        <label for="image">Event Image:</label>
        <input type="file" name="image" id="image" required>

        <label for="package_id">Package:</label>
        <select name="package_id" id="package_id" required>
            <?php
            require_once "db_connection.php";
            $packages = getAllPackages();
            foreach ($packages as $package) {
                echo "<option value='{$package['id']}'>{$package['title']}</option>";
            }
            ?>
        </select>

        <label for="date">Event Date:</label>
        <input type="date" name="date" id="date" required>

        <input type="submit" value="Add Event">
    </form>
</main>
</main>
<?php include 'footer.php';?>
</body>
</html>
