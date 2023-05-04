<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['admin', 'sales', 'client'])) {
    header("Location: login.php");
    exit;
}

require_once "db_connection.php";

$event_id = isset($_GET['event_id']) ? intval($_GET['event_id']) : 0;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $attending = (int)$_POST['attending'];

    $event_id = $_POST['event_id'];

    if (addGuestInvitation($event_id, $name, $email, $attending)) {
        header("Location: guest_invitations.php?event_id=$event_id");
        exit;
    } else {
        echo "Error adding guest invitation.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Guest Invitation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php';?>

    <main>
        <h1>Add Guest Invitation</h1>
        <form action="add-guest-invitation.php?event_id=<?php echo $event_id; ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="attending">Attending:</label>
            <select name="attending" id="attending" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
                <option value="2">Maybe</option>
            </select>

            <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
            <button type="submit">Add Guest Invitation</button>
        </form>
    </main>

    <?php include 'footer.php';?>
</body>
</html>
