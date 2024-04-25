<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shutterspace";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT orders.*, user.username, user.email, user.address
          FROM orders
          JOIN user ON orders.user_id = user.id";

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error fetching orders: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Check Orders</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .order-history {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background-color: #333;
            color: #fff;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            font-weight: bold;
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
            <li><a href="Seller.php">Seller</a></li>
        </ul>
    </nav>
    <a href="seller.php" class="back-button">Back</a>

    <section class="order-history">
        <h2>Order History</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Credit Card</th>
                    <th>Expiry Date</th>
                    <th>CVV</th>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>User Address</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['creditCard']}</td>";
                    echo "<td>{$row['expiryDate']}</td>";
                    echo "<td>{$row['cvv']}</td>";
                    echo "<td>{$row['username']}</td>";
                    echo "<td>{$row['email']}</td>";
                    echo "<td>{$row['address']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table><br>
        <div class="seller-options">
            <a class="link" href="delete_order.php">Delete order</a>
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

<?php
mysqli_close($conn);
?>
