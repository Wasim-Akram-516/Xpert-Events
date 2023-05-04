<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "db_connection.php";

    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'client')");
    $stmt->bind_param("sss", $name, $email, $hashed_password);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        header("Location: login.php?signup_success=1");
    } else {
        header("Location: signup.php?error=1");
    }

    $stmt->close();
    $conn->close();
}
?>
