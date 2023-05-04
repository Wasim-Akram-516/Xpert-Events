<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['admin', 'sales', 'client'])) {
    // Redirect to the login page if the user doesn't have the required role
    header("Location: login.php");
    exit;
}
require_once "db_connection.php";
$events = getEvents();
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
    <h1>Events</h1>
    <table>
        <thead>
            <tr>
                <th>Event Title</th>
                <th>Description</th>
                <th>Image</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($events as $event) {
            ?>
                <tr>
                    <td><?php echo $event['title']; ?></td>
                    <td><?php echo $event['description']; ?></td>
                    <td><img src="images/<?php echo $event['image']; ?>" alt="Event Image" style="max-width: 100px;"></td>
                    <td><?php echo $event['date']; ?></td>
                    <td>
                        <a href="edit-event.php?id=<?php echo $event['id']; ?>" class="link">Edit</a>
                        <a href="delete-event.php?id=<?php echo $event['id']; ?>" class="link" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                        <a href="book-event.php?event_id=<?php echo $event['id']; ?>" class="link" class="book-now-btn">Book Now</a>
                        <a href="guest_invitations.php?event_id=<?php echo $event['id']; ?>" class="link">Manage Guest Invitations</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</main>

<?php include 'footer.php';?>
</body>
</html>
