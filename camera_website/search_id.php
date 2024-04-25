<?php
$conn=mysqli_connect("localhost","root","","shutterspace");
if($conn)
echo "connection successful";
else
{
echo "connection error";
exit();
}
$key=$_POST["sea"];
$q1="SELECT * FROM products where id ='$key'";
$r1=mysqli_query($conn,$q1);
if($r1)
{
$n=mysqli_num_rows($r1);
if($n>0)
{
    <section class="products">
        <h2>Searched Products</h2>
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
}
else
echo "<br>no record found";
}
else
{
echo "error in search operation";
}
mysqli_close($conn);
?>