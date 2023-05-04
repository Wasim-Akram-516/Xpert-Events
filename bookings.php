<?php
session_start();

require_once "db_connection.php";

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role'])) {
    header("Location: login.php");
    exit;
}

$bookings = getBookings($_SESSION['user_id'], $_SESSION['user_role']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xpert Events - Events</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php';?>
<?php include 'user_info.php';?>
<main>
<div class="bookings">
    <h2>Bookings</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Event</th>
                <th>Date</th>
                <?php if ($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'sales'): ?>
                <th>Client Name</th>
                <th>Client Email</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?php echo $booking['id']; ?></td>
                <td><?php echo $booking['event_id']; ?></td>
                <td><?php echo $booking['booking_date']; ?></td>
                <?php if ($_SESSION['user_role'] == 'admin' || $_SESSION['user_role'] == 'sales'): ?>
                <td><?php echo $booking['client_name']; ?></td>
                <td><?php echo $booking['client_email']; ?></td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</main>

<?php include 'footer.php';?>
</body>
</html>

