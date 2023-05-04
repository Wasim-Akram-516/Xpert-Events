<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "db_connection.php";

    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $upload_dir = "images/";
    move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $image);

    $sql = "INSERT INTO packages (title, description, image) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $title, $description, $image);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Package added successfully
        header("Location: packages.php?success=1");
    } else {
        // Error adding package
        header("Location: add-package.php?error=1");
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect to add-package.php if the request method is not POST
    header("Location: add-package.php");
}
?>
