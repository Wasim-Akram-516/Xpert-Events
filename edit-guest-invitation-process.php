<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['admin', 'sales', 'client'])) {
    header("Location: login.php");
    exit;
}
require_once "db_connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $attending = (int)$_POST['attending'];
    $result = updateGuestInvitation($id, $name, $email, $attending);

    if ($result) {
        header("Location: guest_invitations.php?event_id=" . $_SESSION['event_id']);
        exit;
    } else {
        echo "Error updating guest invitation.";
    }
} else {
    header("Location: guest_invitations.php?event_id=" . $_SESSION['event_id']);
    exit;
}
