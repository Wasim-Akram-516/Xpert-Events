<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require_once "db_connection.php";
$event_id = $_GET['event_id'];
$event = getEventById($event_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xpert Events - Book Event</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php';?>
<?php include 'user_info.php';?>
<main>
    <h1>Book Event: <?php echo $event['title']; ?></h1>
    <form action="book-event-process.php" method="post">
        <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" required>

        <input type="submit" value="Book Event">
    </form>
</main>
<?php include 'footer.php';?>
</body>
</html>
