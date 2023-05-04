<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xpert Events - Home</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php';?>

    <main>
    <section class="hero">
        <img src="pics\Event-Planning-Business-in-plan.jpg" alt="Event image">
        <div class="hero-text">
            <div class="hero-text-container">
                <h1>Welcome to Xpert Events</h1>
                <p>Your one-stop solution for all your event management needs</p>
            </div>
        </div>
    </section>

    <section>
        <h2 class="section-title">Our Services</h2>
        <div class="features">
            <div class="feature-box">
                <img src="pics\Corporate-Event-Photography1-13-copy-1.jpg" alt="Corporate events">
                <h3>Corporate Events</h3>
                <p>From conferences to team building events, we've got you covered.</p>
            </div>
            <div class="feature-box">
                <img src="pics\Corporate-Event-Photography1-13-copy-1.jpg" alt="Social events">
                <h3>Social Events</h3>
                <p>Let us help you create unforgettable memories with friends and family.</p>
            </div>
            <div class="feature-box">
                <img src="pics\Corporate-Event-Photography1-13-copy-1.jpg" alt="Public events">
                <h3>Public Events</h3>
                <p>From community gatherings to large-scale festivals, we're here to help.</p>
            </div>
        </div>
    </section>

    <section>
        <h2 class="section-title">Upcoming Events</h2>
        <div class="upcoming-events">
            <?php
                require_once "db_connection.php";
                $events = getEvents();
                foreach ($events as $event) {
                    echo "<div class='event'>";
                    echo "<h3>{$event['title']}</h3>";
                    echo "<img class='event-image' src='images/{$event['image']}' alt='Event Image'>";
                    echo "<p class='event-date'>Date: {$event['date']}</p>";
                    echo "<p>{$event['description']}</p>";
                    echo "</div>";
                }
            ?>
        </div>
    </section>
</main>

    <?php include 'footer.php';?>
</body>
</html>
