<!-- user_info.php -->
<?php
if (isset($_SESSION['user_id'])) {
    echo "<div class='user-info'>";
    echo "<p>Logged in as: {$_SESSION['user_name']} ({$_SESSION['user_role']})</p>";
    echo "<a href='edit-profile.php' class='link'>Edit Profile</a>";
    echo "</div>";
}
?>
