<header>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="events.php">Events</a></li>
            <li><a href="packages.php">Packages</a></li>
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'): ?>
                <li><a href="admin-dashboard.php">Admin Dashboard</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'sales'): ?>
                <li><a href="sales_dashboard.php">Sales Dashboard</a></li>
            <?php endif; ?>
            <li><a href="my-bookings.php">Bookings</a></li>
            <li><a href="contact.php">Contact</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <a href="index.php" class="website-name">Xpert Events</a>
</header>
