<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'sales') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "db_connection.php";

    $name = $_POST['title'];
    $date = $_POST['date'];
    $package_id = $_POST['package_id'];
    $description = $_POST['description'];
    $image = $_FILES['image']['name'];
    $upload_dir = "images/";
    move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $image);

    $sql = "INSERT INTO events (title, description, image, user_id, package_id,date) VALUES (?, ?, ?, ?, ?,?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error . "<br>";
    }

    $stmt->bind_param("sssiis", $name, $description, $image, $_SESSION['user_id'], $package_id,$date);
    $result = $stmt->execute();

    if ($result) {
        // Event added successfully
        header("Location: events.php?success=1");
    } else {
        // Error adding event
        echo "Error executing statement: " . $stmt->error . "<br>";
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect to add-event.php if the request method is not POST
    header("Location: add-event.php");
}
?>
