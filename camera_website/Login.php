<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shutterspace";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$loginMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = $_POST['password'];

        $loginQuery = "SELECT * FROM user WHERE email='$email'";
        $loginResult = mysqli_query($conn, $loginQuery);

        if (mysqli_num_rows($loginResult) > 0) {
            $user = mysqli_fetch_assoc($loginResult);
            if (password_verify($password, $user['password'])) {
                $loginMessage = "Login successful";
                setcookie("email", $email, time() + 3600, "/");
            } else {
                $loginMessage = "Incorrect password";
            }
        } else {
            $loginMessage = "User not found";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="logo.png" alt="Logo">
            <span class="brandName">Shutter Space</span>
        </div>
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="seller.php">Seller</a></li>
        </ul>
    </nav>
    <a href="index.php" class="back-button">Back</a>
    <section class="add-product">
        <h2>User Login</h2>
        <form action="login.php" method="post">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <div class="profile-actions">
                <button type="submit" name="login">Login</button>
            </div>
            <?php if (!empty($loginMessage)): ?>
                <div class="centered-message">
                    <?php echo $loginMessage; ?>
                </div>
            <?php endif; ?>
        </form>
    </section>

    <footer class="footer">
        <div class="footer-cta">
            <h2>Keep the Inspiration Going</h2>
            <p>Don’t miss out - stay connected with Nikon to receive the latest news, events, and promotions to fuel
                your creative vision.</p>
            <div class="signup-buttons">
                <a class="cta-link" href="Signup.php" style="margin-right:6%">Sign Up</a>
                <a class="cta-link" href="Login.php">Login</a>
            </div>
        </div>
        <p>&copy; 2023 Shutterspace. All rights reserved.</p>
    </footer>
</body>

</html>