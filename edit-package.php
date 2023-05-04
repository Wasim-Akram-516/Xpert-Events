<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("Location: login.php");
    exit;
}
require_once "db_connection.php";
$package_id = $_GET['id'];
$package = getPackageById($package_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xpert Events - Edit Package</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php';?>
<?php include 'user_info.php';?>
<main>
    <h1>Edit Package</h1>
    <form action="edit-package-process.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $package['id']; ?>">
        <label for="title">Package Title:</label>
        <input type="text" name="title" id="title" value="<?php echo $package['title']; ?>" required>

        <label for="description">Package Description:</label>
        <textarea name="description" id="description" required><?php echo $package['description']; ?></textarea>

        <label for="price">Package Price:</label>
        <input type="number" name="price" id="price" value="<?php echo $package['price']; ?>" required>

        <label for="image">Package Image:</label>
        <input type="file" name="image" id="image">
        <img src="images/<?php echo $package['image']; ?>" alt="Current Package Image" width="100">
        <input type="hidden" name="current_image" value="<?php echo $package['image']; ?>">

        <input type="submit" value="Update Package">
    </form>
</main>
<?php include 'footer.php';?>
</body>
</html>
