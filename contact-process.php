<?php

require_once 'db_connection.php'; // Add the database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Insert the message into the messages table
    $stmt = $conn->prepare("INSERT INTO messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);
    $result = $stmt->execute();

    $stmt->close(); // Close the prepared statement

    if ($result) {
        header("Location: contact.php?success=1");
    } else {
        header("Location: contact.php?error=1");
    }
}
