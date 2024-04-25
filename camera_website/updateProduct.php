<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shutterspace";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$notFound = false;
$product = null;
$updated = false;
$initialized= false;
$successMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["search"])) {
        $productId = mysqli_real_escape_string($conn, $_POST["productId"]);
        $searchQuery = "SELECT * FROM products WHERE id='$productId'";
        $result = mysqli_query($conn, $searchQuery);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $product = $row;
            }
        } else {
            $notFound = true;
        }
    } elseif (isset($_POST["update"])) { 
        $productId = $_POST["id"];
        $productName = mysqli_real_escape_string($conn, $_POST["name"]); 
        $productDescription = mysqli_real_escape_string($conn, $_POST["description"]); 
        $productPrice = mysqli_real_escape_string($conn, $_POST["price"]); 
        $productImage = mysqli_real_escape_string($conn, $_POST["image"]);

        $updateQuery = "UPDATE products 
                        SET name='$productName', description='$productDescription', image='$productImage', price='$productPrice' 
                        WHERE id='$productId'";
        $initialized=true;
        if (mysqli_query($conn, $updateQuery)) {
            $updated = true;
            $successMessage = "Product Updated successfully";
        } else {
            $updated = false;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product Details</title>
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
            <li><a href="seller.php" target="_blank">Seller</a></li>
        </ul>
    </nav>
    <a href="seller.php" class="back-button">Back</a>
    <section class="add-product">
        <h2>Update Product Details</h2>
        <form method="post">
            <label for="productId">Product Id:</label>
            <input type="number" id="productId" name="productId" required>
            <button type="submit" name="search">Search Product</button>
            <?php
            if ($notFound) {
                echo '<div class="centered-message">';
                echo 'Product not found';
                echo '</div>';
            }
            ?>
        </form>

        <?php if ($product !== null): ?>
            <form action="" method="post">
                <label for="name">Name:</label>
                <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br>

                <label for="description">Description:</label>
                <textarea name="description" required><?php echo $product['description']; ?></textarea><br>

                <label for="price">Price:</label>
                <input type="number" name="price" value="<?php echo $product['price']; ?>" required><br>

                <label for="image_link">Image Link:</label>
                <input type="text" name="image" value="<?php echo $product['image']; ?>" required><br>

                <input type="hidden" name="id" value="<?php echo $productId; ?>">
                <button type="submit" name="update">Update</button>
                <?php 
                    if($updated && !$initialized){
                        echo '<div class="centered-message error">';
                        echo 'Something went wrong';
                        echo '</div>';
                    }
                ?>
                
            </form>
        <?php endif; ?>
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