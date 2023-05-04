<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'sales') {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "db_connection.php";

    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $package_id = $_POST['package_id'];

    $image = $_FILES['image']['name'];

    if ($image) {
        $old_image = getEventById($id)['image'];
    
        if (file_exists("images/$old_image")) {
            unlink("images/$old_image");
        }
    
        $upload_dir = "images/";
        move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $image);
        $sql = "UPDATE events SET title=?, description=?, image=?, date=?, package_id=? WHERE id=?";
        $stmt = $conn->prepare($sql);
    
        if (!$stmt) {
            echo "Error preparing statement: " . $conn->error . "<br>";
        }
    
        $stmt->bind_param("ssssii", $title, $description, $image, $date, $package_id, $id);
    } else {
        $sql = "UPDATE events SET title=?, description=?, date=?, package_id=? WHERE id=?";
        $stmt = $conn->prepare($sql);
    
        if (!$stmt) {
            echo "Error preparing statement: " . $conn->error . "<br>";
        }
    
        $stmt->bind_param("sssii", $title, $description, $date, $package_id, $id);
    }
    
    

    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Event updated successfully
        header("Location: events.php?success=1");
    } else {
        // Error updating event
        header("Location: edit-event.php?id=$id&error=1");
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect to events.php if the request method is not POST
    header("Location: events.php");
}
