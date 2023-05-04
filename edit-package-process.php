<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("Location: login.php");
    exit;
}
require_once "db_connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    $image = $current_image;

    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        $upload_directory = "images/";
        $uploaded_file = $upload_directory . basename($_FILES["image"]["name"]);
        $image_file_type = strtolower(pathinfo($uploaded_file, PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploaded_file)) {
            $image = basename($_FILES["image"]["name"]);
            if ($current_image != $image) {
                unlink($upload_directory . $current_image);
            }
        }
    }

    $result = updatePackage($id, $title, $description, $price, $image);

    if ($result) {
        header("Location: packages.php");
        exit;
    } else {
        echo "Error updating package.";
    }
} else {
    header("Location: packages.php");
    exit;
}
?>
