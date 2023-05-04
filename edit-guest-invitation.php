<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['admin', 'sales', 'client'])) {
    header("Location: login.php");
    exit;
}
require_once "db_connection.php";

$invitation_id = $_GET['id'];
$invitation = getGuestInvitationById($invitation_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xpert Events - Edit Guest Invitation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php';?>
<?php include 'user_info.php';?>
<main>
    <h1>Edit Guest Invitation</h1>
    <form action="edit-guest-invitation-process.php" method="post">
        <input type="hidden" name="id" value="<?php echo $invitation['id']; ?>">
        <label for="name">Guest Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $invitation['name']; ?>" required>

        <label for="email">Guest Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $invitation['email']; ?>" required>

        <label for="attending">Attending:</label>
        <select name="attending" required>
            <option value="1" <?php echo $invitation['attending_status'] == 1 ? 'selected' : ''; ?>>Yes</option>
            <option value="0" <?php echo $invitation['attending_status'] == 0 ? 'selected' : ''; ?>>No</option>
            <option value="2" <?php echo $invitation['attending_status'] == 2 ? 'selected' : ''; ?>>Maybe</option>
        </select>



        <input type="submit" value="Update Invitation">
    </form>
</main>
<?php include 'footer.php';?>
</body>
</html>
