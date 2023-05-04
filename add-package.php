<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xpert Events - Add Package</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php';?>
<?php include 'user_info.php';?>
<main>
    <h1>Add Package</h1>
    <form action="add-package-process.php" method="post" enctype="multipart/form-data">
        <label for="title">Package Title:</label>
        <input type="text" name="title" id="title" required>

        <label for="description">Package Description:</label>
        <textarea name="description" id="description" required></textarea>

        <label for="image">Package Image:</label>
        <input type="file" name="image" id="image" required>

        <input type="submit" value="Add Package">
    </form>
</main>

    <?php include 'footer.php';?>
</body>
</html>
