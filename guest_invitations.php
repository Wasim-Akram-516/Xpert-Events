<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['admin', 'sales'])) {
    header("Location: login.php");
    exit;
}
require_once "db_connection.php";

$event_id = $_GET['event_id'];
$_SESSION['event_id'] = $event_id;
$guest_invitations = getGuestInvitations($event_id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xpert Events - Guest Invitations</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php';?>
<?php include 'user_info.php';?>
<main>
    <h1>Guest Invitations</h1>
    <a href="add-guest-invitation.php?event_id=<?php echo $event_id; ?>" class="link">Add Guest Invitation</a>
    <table>
        <thead>
            <tr>
                <th>Guest Name</th>
                <th>Email</th>
                <th>Attending</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($guest_invitations as $guest_invitation) {
            ?>
                <tr>
                    <td><?php echo $guest_invitation['name']; ?></td>
                    <td><?php echo $guest_invitation['email']; ?></td>
                    <td>
                        <?php
                        if ($guest_invitation['attending_status'] == 1) {
                            echo 'Yes';
                        } elseif ($guest_invitation['attending_status'] == 0) {
                            echo 'No';
                        } else {
                            echo 'Maybe';
                        }
                        ?>
                    </td>
                    <td>
                        <a href="edit-guest-invitation.php?id=<?php echo $guest_invitation['id']; ?>" class="link">Edit</a>
                        <a href="delete-guest-invitation.php?id=<?php echo $guest_invitation['id']; ?>" class="link" onclick="return confirm('Are you sure you want to delete this guest invitation?');">Delete</a>
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
