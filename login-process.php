<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "db_connection.php";

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT id, email, name, role, password FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            // Password is correct, set session variables and redirect
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_role'] = $row['role'];
            
            if ($row['role'] == 'sales') {
                header("Location: sales_dashboard.php");
            } elseif ($row['role'] == 'admin') {
                header("Location: admin-dashboard.php");
            } elseif ($row['role'] == 'client') {
                header("Location: index.php");
            }
            else{
                header("Location: index.php");
            }
        } else {
            // Invalid email or password
            header("Location: login.php?error=1");
        }
    } else {
        // Invalid email or password
        header("Location: login.php?error=1");
    }

    $stmt->close();
    $conn->close();
}
?>
