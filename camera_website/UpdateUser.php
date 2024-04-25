<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shutterspace";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userid = $_POST["id"];
            $useremail=$_POST["email"];
            $username = $_POST["name"];
            $userage = $_POST["age"];
            $usergender = $_POST["gender"];
            $useraddress = $_POST["address"];

            $updateQuery = "UPDATE user SET 
                            email = '$useremail',
                            name = '$username',
                            age = $userage,
                            gender = '$usergender',
                            address = '$usersddress'
                            WHERE id = 1";

            if (mysqli_query($conn, $updateQuery)) {
                echo "Product updated successfully";
            } else {
                echo "Error updating product: " . mysqli_error($conn);
            }
    }
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shutterspace-update user</title>
    <link rel="stylesheet" href="style.css">
    <style>
        #buttons-container {
            text-align: center;
            margin-top: 20px;
        }

        #buttons-container button {
            display: inline-block; 
            margin-right: 10px;
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
            <li><a href="profile.php">Profile</a></li>
            <li><a href="seller.php">Seller</a></li>
        </ul>
    </nav>

    <section class="add-product">
        <h2>User Details</h2>
        <form  method="post">
        <label for="userId">User Id:</label>
            <input type="number" id="userId" name="id" value="<?php echo 1 ?>" required>

            <label for="useremail">Email:</label>
            <input type="text" id="useremail" name="email" value="<?php echo $userData['email']; ?>" required>

            <label for="username">Name:</label>
            <input type="text" id="username" name="name" value="<?php echo isset($userData['name']) ? $userData['name'] : ''; ?>" required>

            <label for="userage">Age:</label>
            <textarea id="userage" name="age" required><?php echo $userData['age']; ?></textarea>

            <label for="usergender">Gender:</label>
            <textarea type="text" id="usergender" name="gender" value="<?php echo isset($userData['gender']) ? $userData['gender'] : ''; ?>" required></textarea>

            <label for="useraddress">Address:</label>
            <input type="text" id="useraddress" name="address" value="<?php echo $userData['address']; ?>" required></input>

            <div id="buttons-container">
                <button type="submit" >Update Details</button>
            </div>
        </form>
    </section>
    
    <footer class="footer">
        <div class="footer-cta">
            <h2>Keep the Inspiration Going</h2>
            <p>Don’t miss out - stay connected with Shutterspace to receive the latest news, events, and promotions to fuel
                your creative vision.</p>
            <div class="signup-buttons">
                <a class="cta-link" href="" target="_blank">Sign Up</a>
            </div>
        </div>
        <p>&copy; 2023 Shutterspace. All rights reserved.</p>
    </footer>
</body>

</html>