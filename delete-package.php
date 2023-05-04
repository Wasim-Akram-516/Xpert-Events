<?php
session_start();

if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['admin', 'sales'])) {
    // Redirect to the login page if the user doesn't have the required role
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    require_once "db_connection.php";
    $id = $_GET['id'];

    $sql = "DELETE FROM packages WHERE id=?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $id);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Package deleted successfully
            header("Location: packages.php?success=1");
        } else {
            // Error deleting package
            header("Location: packages.php?error=1");
        }

        $stmt->close();
    } else {
        // Error preparing statement
        header("Location: packages.php?error=2");
    }

    $conn->close();
} else {
    // Redirect to packages.php if the request method is not GET or the 'id' parameter is not set
    header("Location: packages.php");
}
?>
