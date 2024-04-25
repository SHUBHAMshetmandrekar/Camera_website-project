<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shutterspace";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shutterspace-seller</title>
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
    <div class="seller-content">
        <h2>Welcome, Seller!</h2>
        <p>Choose an option below:</p>
        <div class="seller-options">
            <a class="link" href="addProduct.php">Add New Product</a>
            <a class="link" href="updateProduct.php">Update Existing Product</a>
            <a class="link" href="deleteProduct.php">Delete Product</a>
            <a class="link" href="checkOrders.php">Check Orders</a> 
            <a class="link" href="update_order.php">Update order</a>
            <a class="link" href="delete_order.php">Delete order</a>
        </div>
    </div>
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
