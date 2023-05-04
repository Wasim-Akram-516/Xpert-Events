<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

require_once "db_connection.php";
$user_id = $_SESSION['user_id'];
$user_data = getUserData($user_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

    $stmt = $conn->prepare("UPDATE users SET name=?, email=?, password=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $email, $hashed_password, $user_id); 
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        if ($_SESSION['user_role'] == 'admin') {
            header("Location: admin-dashboard.php?success=1");
        } elseif ($_SESSION['user_role'] == 'sales') {
            header("Location: sales_dashboard.php?success=1");
        } else {
            header("Location: events.php?success=1");
        }
    } else {
        header("Location: edit-profile.php?error=1");
    }
    

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php';?>

    <main>
        <h1>Edit Profile</h1>
        <form action="edit-profile.php" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo $user_data['name']; ?>">
            
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $user_data['email']; ?>">
            
            <label for="password">Password:</label>
            <input type="text" name="password" id="password" value="<?php echo $user_data['password']; ?>">

            <button type="submit">Save</button>
        </form>
    </main>

    <?php include 'footer.php';?>
</body>
</html>
