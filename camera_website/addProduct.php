<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shutterspace";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$successMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST["productName"];
    $productDescription = $_POST["productDescription"];
    $productPrice = $_POST["productPrice"];
    $productImage = $_POST["productImage"];

    $insertQuery = "INSERT INTO products (name, description, price, image) 
                    VALUES ('$productName', '$productDescription', '$productPrice', '$productImage')";

    if (mysqli_query($conn, $insertQuery)) {
        $successMessage = "New product added successfully";
    } else {
        echo "Error: " . $insertQuery . "<br>" . mysqli_error($conn);
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
   
    <title>Shutterspace-add product</title>
    <link rel="stylesheet" href="style.css">

    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .add-product {
            flex: 1;
            padding: 20px;
        }
    </style>
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
    <a href="seller.php" class="back-button">Back</a>
    <section class="add-product">
        <h2>Add New Product</h2>
        <form action="addProduct.php" method="post">
            <label for="productName">Product Name:</label>
            <input type="text" id="productName" name="productName" required>

            <label for="productDescription">Product Description:</label>
            <textarea id="productDescription" name="productDescription" required></textarea>

            <label for="productPrice">Product Price:</label>
            <input type="number" id="productPrice" name="productPrice" required>

            <label for="productImage">Product Image URL:</label>
            <input type="text" id="productImage" name="productImage" required>

            <button type="submit">Add Product</button>

            <?php if (!empty($successMessage)) : ?>
                <div class="centered-message">
                    <?php echo $successMessage; ?>
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
