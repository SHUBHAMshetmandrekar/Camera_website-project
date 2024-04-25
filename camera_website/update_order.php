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
        $orderid = mysqli_real_escape_string($conn, $_POST["orderid"]);
        $searchQuery = "SELECT * FROM orders WHERE id='$orderid'";
        $result = mysqli_query($conn, $searchQuery);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $product = $row;
            }
        } else {
            $notFound = true;
        }
    } elseif (isset($_POST["update"])) { 
        $orderid =$_POST["id"];
        $creditCard = mysqli_real_escape_string($conn, $_POST["creditCard"]); 
        $expiryDate = mysqli_real_escape_string($conn, $_POST["expiryDate"]); 
        $cvv = mysqli_real_escape_string($conn, $_POST["cvv"]); 
        $orderDate = mysqli_real_escape_string($conn, $_POST["orderDate"]);

        $updateQuery = "UPDATE orders 
                        SET creditCard='$creditCard', expiryDate ='$expiryDate', cvv='$cvv', orderDate='$orderDate' 
                        WHERE id='$orderid'";
        $initialized=true;
        if (mysqli_query($conn, $updateQuery)) {
            $updated = true;
            $successMessage = "order Updated successfully";
        } else {
            $updated = false;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Update Order Details</title>
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
            <label for="productId">Order Id:</label>
            <input type="number" id="productId" name="orderid" required>
            <button type="submit" name="search">Search order</button>
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
                <label for="creditCard">Credit Card Number:</label>
                <input type="text" id="creditCard" name="creditCard" value="<?php echo $product['creditCard']; ?>" required>

                <label for="expiryDate">Expiry Date:</label>
                <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/YY" value="<?php echo $product['expiryDate']; ?>" required>

                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" value="<?php echo $product['cvv']; ?>" required>

                <label for="oDate">Order Date:</label>
                <input type="text" id="oDate" name="orderDate" placeholder="MM/YY" value="<?php echo $product['orderDate']; ?>" required>

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