<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shutterspace";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$loggedIn = isset($_COOKIE['email']);
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && $loggedIn) {
    $creditCard = mysqli_real_escape_string($conn, $_POST["creditCard"]);
    $expiryDate = mysqli_real_escape_string($conn, $_POST["expiryDate"]);
    $cvv = mysqli_real_escape_string($conn, $_POST["cvv"]);
    $email = $_COOKIE['email'];

    $userCheckQuery = "SELECT * FROM user WHERE email='$email'";
    $userCheckResult = mysqli_query($conn, $userCheckQuery);

    if (mysqli_num_rows($userCheckResult) > 0) {
        $user = mysqli_fetch_assoc($userCheckResult);
        $user_id = $user['id'];

        $insertQuery = "INSERT INTO orders (creditCard, expiryDate, cvv, user_id) 
                        VALUES ('$creditCard', '$expiryDate', '$cvv', '$user_id')";

        if (mysqli_query($conn, $insertQuery)) {
            $successMessage = "Order placed successfully";
        } else {
            echo "Error processing payment: " . mysqli_error($conn);
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
    <title>Your Camera Store</title>
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
            <li><a href="Seller.php">Seller</a></li>
        </ul>
    </nav>
    <section class="add-product">
        <?php if (!$loggedIn): ?>
            <div class="signup-buttons">
                <a class="cta-link" href="Signup.php" target="_blank" style="margin-right:6%">Sign Up</a>
                <a class="cta-link" href="Login.php" target="_blank">Login</a>
            </div>
        <?php else: ?>
            <h2>Billing Information</h2>
            <form action="billing.php" method="post">
                <label for="creditCard">Credit Card Number:</label>
                <input type="text" id="creditCard" name="creditCard" required>

                <label for="expiryDate">Expiry Date:</label>
                <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/YY" required>

                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" required>

                <button type="submit">Process Payment</button>

                <?php if (!empty($successMessage)): ?>
                    <div class="centered-message">
                        <?php echo $successMessage; ?>
                    </div>
                <?php endif; ?>
            </form>
        <?php endif; ?>
    </section>
    <footer class="footer">
        <div class="footer-cta">
            <h2>Keep the Inspiration Going</h2>
            <p>Don’t miss out - stay connected with Nikon to receive the latest news, events, and promotions to fuel
                your creative vision.</p>
            <div class="signup-buttons">
                <?php if (!$loggedIn): ?>
                    <a class="cta-link" href="signup.php" style="margin-right:6%">Sign Up</a>
                    <a class="cta-link" href="login.php">Login</a>
                <?php endif; ?>
            </div>
        </div>
        <p>&copy; 2023 Shutterspace. All rights reserved.</p>
    </footer>
</body>

</html>
