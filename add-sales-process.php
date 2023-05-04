<?php
require_once "db_connection.php";

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header("Location: login.php");
    exit;
}

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

global $conn;

$stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'sales')");
$stmt->bind_param("sss", $name, $email, $password);
$stmt->execute();
$stmt->close();
$conn->close();

header("Location: admin-dashboard.php");
exit;
