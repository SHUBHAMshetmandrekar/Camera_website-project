<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shutterspace";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$query = "SELECT * FROM products";
$result = mysqli_query($conn, $query);
$products = array();

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $products[] = $row;
    }
} else {
    echo "No products found.";
}
$search_id = isset($_POST["search"]) ? $_POST["search"] : "";
$searchQuery = "SELECT * FROM products where id='$search_id'" ;
$search_result=mysqli_query($conn, $searchQuery);
$search_products = array();
if (mysqli_num_rows($search_result) > 0) {
    while ($row = mysqli_fetch_assoc($search_result)) {
        $search_products[] = $row;
    }
} else {
    
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shutterspace</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>

</style>
<body style="overflow-x:hidden ;">
    <nav class="navbar">
        <div class="logo">
            <img src="logo.png" alt="Logo">
            <span class="brandName">Shutter Space</span>
        </div>
        <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="Seller.php">Seller</a></li>
            
            <div class="search-container" >
                <form  style="display: flex; justify-content:space-between;align-items: center;" method="POST">
                <input style="padding: 8px; border-radius: 5px;" type="text" placeholder="Search by id.." name="search" value=''>
                <button style="padding: 8px 12px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;" type="submit">search</button>
                </form>
            </div>
        </ul>
    </nav>
    <?php
if (isset($search_products)) {
    if($search_id>0){
        echo "<section class='products'>";
        echo "<h2>Search Results</h2>";
        echo "<div class='product-container' id='searchResultsContainer'>";
    }
    
    foreach ($search_products as $product) {
        echo "
                <div class='product-item'>
                    <img src='{$product['image']}' alt='product image'>
                    <h3>{$product['name']}</h3>
                    <p>{$product['description']}</p>
                    <span class='price'>₹" . number_format($product['price']) . "</span>
                    <a class='buy-link' href='billing.php'>Buy Now</a>
                </div>
            ";
    }
    
    echo "</div>";
    echo "</section>";
}
else{
    echo "No products found for the given ID.";
}
?>
    <header class="hero">
        <div class="hero-content">
            <h1>Welcome to Your Shutter Space</h1>
            <p>Discover the best cameras for your photography needs.</p>
        </div>
    </header>
    <section class="products">
        <h2>Featured Products</h2>
        <div class="product-container" id="productContainer">
            <?php
            foreach ($products as $product) {
                echo "
                        <div class='product-item'>
                            <img src='{$product['image']}' alt='product image'>
                            <h3>{$product['name']}</h3>
                            <p>{$product['description']}</p>
                            <span class='price'>₹" . number_format($product['price']) . "</span>
                            <a class='buy-link' href='billing.php'>Buy Now</a>
                        </div>
                    ";
            }
            ?>
        </div>
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