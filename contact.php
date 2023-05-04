<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xpert Events - Contact</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php include 'header.php';?>
<?php include 'user_info.php';?>
    <main>
        <h1>Contact Us</h1>
        <form action="contact-process.php" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required>

            <label for="message">Message:</label>
            <textarea name="message" id="message" required></textarea>

            <input type="submit" value="Submit">

            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
            <div class="alert alert-success">
                <strong>Success!</strong> Your message has been sent.
            </div>

            <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
            <div class="alert alert-danger">
                <strong>Error!</strong> There was a problem sending your message. Please try again later.
            </div>
<?php endif; ?>

<?php endif; ?>

        </form>
    </main>
    <?php include 'footer.php';?>
</body>
</html>
