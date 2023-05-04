<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "db_connection.php";

    $event_id = $_POST['event_id'];
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $booking_date = date('Y-m-d');

    $sql = "INSERT INTO bookings (user_id, event_id, name, email, phone, booking_date) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissss", $user_id, $event_id, $name, $email, $phone, $booking_date);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        // Booking created successfully
        header("Location: my-bookings.php?success=1");
    } else {
        // Error creating booking
        header("Location: book-event.php?event_id=$event_id&error=1");
    }

    $stmt->close();
    $conn->close();
} else {
    // Redirect to events.php if the request method is not POST
    header("Location: events.php");
}
