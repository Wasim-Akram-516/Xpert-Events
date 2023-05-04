<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xpert Events - Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <h1>Register</h1>
        <form action="register-process.php" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <input type="submit" value="Register">
        </form>
    </main>

   <?php include 'footer.php'; ?>
</body>
</html>
