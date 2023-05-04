<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'sales') {
    header("Location: login.php");
    exit;
}
require_once "db_connection.php";
$event_id = $_GET['id'];
$event = getEventById($event_id);
$packages = getAllPackages();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xpert Events - Edit Event</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php';?>
<?php include 'user_info.php';?>
<main>
    <h1>Edit Event</h1>
    <form action="edit-event-process.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $event['id']; ?>">

        <label for="title">Event Title:</label>
        <input type="text" name="title" id="title" value="<?php echo $event['title']; ?>" required>

        <label for="description">Event Description:</label>
        <textarea name="description" id="description" required><?php echo $event['description']; ?></textarea>

        <label for="image">Event Image:</label>
        <input type="file" name="image" id="image">
        <img src="images/<?php echo $event['image']; ?>" alt="Event Image" style="max-width: 100px;">

        <label for="package_id">Package:</label>
        <select name="package_id" id="package_id" required>
            <?php
            foreach ($packages as $package) {
                $selected = $package['id'] == $event['package_id'] ? 'selected' : '';
                echo "<option value='{$package['id']}' $selected>{$package['title']}</option>";
            }
            ?>
        </select>

        <label for="date">Event Date:</label>
        <input type="date" name="date" id="date" value="<?php echo $event['date']; ?>" required>

        <input type="submit" value="Update Event">
    </form>
</main>

<?php include 'footer.php';?>
</body>
</html>
