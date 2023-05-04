<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xpert Events - Sales Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php';?>
<?php include 'user_info.php';?>
    <main>
        <h1>Sales Dashboard</h1>
        
        <?php
        if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'sales') {
            echo '<p><a href="add-event.php" class="link">Add Event</a></p>';
        } else {
            echo '<p>You do not have permission to access this page.</p>';
        }
        ?>
    </main>
<?php include 'footer.php';?>
</body>
</html>
