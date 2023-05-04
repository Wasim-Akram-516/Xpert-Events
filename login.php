<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xpert Events - Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<?php include 'header.php';?>
<?php include 'user_info.php';?>
<main>
    <h1>Login</h1>
    <form action="login-process.php" method="post"> 
        <label for="email">Email:</label> 
        <input type="email" name="email" id="email" required> 

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>

        <input type="submit" value="Login">
        <p>Don't have an account? <a href="register.php">Sign up</a>.</p>
        <?php if (isset($_GET['error'])): ?>
         <div class="error-message">
         <p>Invalid Username or Password</p>
        </div>
        <?php endif; ?>


    </form>

</main>

<?php include 'footer.php';?>
</body>
</html>
