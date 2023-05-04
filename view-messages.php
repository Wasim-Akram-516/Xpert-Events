<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("Location: login.php");
    exit;
}
require_once "db_connection.php";

// Fetch messages from the database
$messages = getAllMessages();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xpert Events - View Messages</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php';?>
<main>
    <h1>View Messages</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
        </tr>
        <?php foreach ($messages as $message) { ?>
        <tr>
            <td><?php echo $message['name']; ?></td>
            <td><?php echo $message['email']; ?></td>
            <td><?php echo $message['subject']; ?></td>
            <td><?php echo $message['message']; ?></td>
        </tr>
        <?php } ?>
    </table>
</main>
<?php include 'footer.php';?>
</body>
</html>
