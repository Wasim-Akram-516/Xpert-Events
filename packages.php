<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['user_role'] != 'admin' && $_SESSION['user_role'] != 'admin')) {
    header("Location: login.php");
    exit;
}

require_once "db_connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];

    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Upload the image
    $target_dir = "images/";
    $image_name = time() . "_" . basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $image_name;
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    if ($action == 'add') {
        // Call addPackage() function
        addPackage($title, $description, $price, $image_name);
    } elseif ($action == 'edit') {
        $package_id = $_POST['package_id'];
        // Call updatePackage() function
        updatePackage($package_id, $title, $description, $price, $image_name);
    } elseif ($action == 'delete') {
        $package_id = $_POST['package_id'];
        // Call deletePackage() function
        deletePackage($package_id);
    }

    // Redirect to packages.php
    header("Location: packages.php");
    exit;
}

$packages = getAllPackages();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Packages</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php';?>

    <main>
        <h1>Manage Packages</h1>
        <h2>Add Package</h2>
        <form action="packages.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
            <label for="description">Description:</label>
            <textarea name="description" id="description" required></textarea>
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" required>
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" step="0.01" required>
            <button type="submit">Add Package</button>
        </form>

        <h2>Existing Packages</h2>
        <table>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($packages as $package) { ?>
            <tr>
                <td><?php echo $package['title']; ?></td>
                <td><?php echo $package['description']; ?></td>
                <td><img src="images/<?php echo $package['image']; ?>" alt="<?php echo $package['title']; ?>" width="100"></td>
                <td><?php echo $package['price']; ?></td>
                <td>
                    <form action="edit-package.php" method="get" class="inline-form">
                        <input type="hidden" name="id" value="<?php echo $package['id']; ?>">
                        <button type="submit">Edit</button>
                    </form>

                    <form action="packages.php" method="post" class="inline-form">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="package_id" value="<?php echo $package['id']; ?>">
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this package?');">Delete</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </main>

    <?php include 'footer.php';?>
</body>
</html>
