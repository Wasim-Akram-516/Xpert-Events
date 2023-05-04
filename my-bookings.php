<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once "db_connection.php";
$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['user_role'];

if ($user_role === 'admin' || $user_role === 'sales') {
    $bookings = getAllBookings();
} else {
    $bookings = getUserBookings($user_id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xpert Events - My Bookings</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php';?>
<?php include 'user_info.php';?>
<main>
    <h1>My Bookings</h1>
    <table>
        <tr>
            <th>Event</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Booking Date</th>
            <?php if ($user_role === 'admin' || $user_role === 'sales') { ?>
            <th>Client</th>
            <?php } ?>
        </tr>
        <?php foreach ($bookings as $booking) { ?>
        <tr>
            <td><?php echo $booking['event_title']; ?></td>
            <td><?php echo $booking['name']; ?></td>
            <td><?php echo $booking['email']; ?></td>
            <td><?php echo $booking['phone']; ?></td>
            <td><?php echo $booking['booking_date']; ?></td>
            <?php if ($user_role === 'admin' || $user_role === 'sales') { ?>
            <td><?php echo $booking['client_name']; ?></td>
            <?php } ?>
        </tr>
        <?php } ?>
    </table>
</main>
<?php include 'footer.php';?>
</body>
</html>
