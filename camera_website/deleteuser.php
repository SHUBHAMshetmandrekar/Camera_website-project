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
    $userid = 1;

    $deleteQuery = "DELETE FROM user WHERE id=$userid";

    if (mysqli_query($conn, $deleteQuery)) {
        $successMessage = "Account is Deleted";
    } else {
        echo " Error deleting product: . mysqli_error($conn)";
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shutterspace - Deletion Confirmation</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .confirmation-container {
            text-align: center;
            margin-top: 30px;
        }

        .confirmation-message {
            font-size: 20px;
            margin-bottom: 20px;
        }

        .back-to-home,
        .confirm-delete {
            display: inline-block;
            padding: 10px 10px;
            text-decoration: none;
            border-radius: 5px;
            margin: 5px;
        }
            
        
        #buttons-container {
            text-align: center; /* Center the buttons */
            margin-top: 20px; /* Add margin for spacing */
            display: flex;
            justify-content: space-around;
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Set the minimum height of the body to 100% of the viewport height */
            margin: 0;
            }

            .footer {
                margin-top: auto; /* This will push the footer to the bottom */
                padding: 20px; /* Add padding for better spacing */
            }
            
            .add-product {
                flex: 1;
                padding: 20px; /* Add padding for better spacing */
            }
            .centered-message {
            padding: 20px;
            background-color: red;
            color: #fff;
            border-radius: 8px;
            text-align: center;
            font-size: 20px;
            margin: auto; /* This centers the element horizontally */
            margin-top: 20px; /* Add margin-top to create space between the button and the message */
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
<section class="add-product">
    <form method="post">
    <div class="confirmation-container">
        <p class="confirmation-message">Are you sure you want to delete the Account?</p>
        <button type="submit" class="confirm-delete">Yes</button>
    </div>
    </form>
    <div class="confirmation-container">
    <a href="index.php"  class="confirm-delete"><button >Back to Home Page </button></a>
        </div>

    <?php if (!empty($successMessage)) : ?>
                <div class="centered-message">
            <?php echo $successMessage; ?>
            </div>
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
