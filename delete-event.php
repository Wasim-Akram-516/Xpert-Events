<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['sales'])) {
    // Redirect to the login page if the user doesn't have the required role
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    require_once "db_connection.php";
    $id = $_GET['id'];

    // Get the event's image file name
    $event = getEventById($id);
    $image = $event['image'];

    // Delete the event's image file
    if ($image) {
        unlink("images/$image");
    }

    // Delete the event from the database
    $sql = "DELETE FROM events WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Event deleted successfully
        header("Location: events.php?success=1");
    } else {
        // Error deleting event
        header("Location: events.php?error=1");
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect to events.php if the request method is not GET or the 'id' parameter is not set
    header("Location: events.php");
}
