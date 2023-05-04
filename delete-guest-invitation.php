<?php
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_role']) || !in_array($_SESSION['user_role'], ['admin', 'sales','client'])) {
    header("Location: login.php");
    exit;
    }
    require_once "db_connection.php";
    
    if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = deleteGuestInvitation($id);
    if ($result) {
        header("Location: guest_invitations.php?event_id=" . $_SESSION['event_id']);
        exit;
    } else {
        echo "Error deleting guest invitation.";
    }
} else {
    header("Location: guest_invitations.php?event_id=" . $_SESSION['event_id']);
    exit;
    }