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
    if (isset($_POST['signup'])) {
        $name = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);

        $emailCheckQuery = "SELECT * FROM user WHERE email='$email'";
        $emailCheckResult = mysqli_query($conn, $emailCheckQuery);

        if (mysqli_num_rows($emailCheckResult) > 0) {
            $successMessage = "Email already exists. Please use a different email.";
        } else {
            $insertQuery = "INSERT INTO user (username, email, password, age, gender, address) 
                            VALUES ('$name', '$email', '$password', '$age', '$gender', '$address')";

            if (mysqli_query($conn, $insertQuery)) {
                $successMessage = "User registered successfully";

                setcookie("email", $email, time() + 3600, "/");
            } else {
                $successMessage = "Error registering user: " . mysqli_error($conn);
            }
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
    <title>User Signup</title>
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
    <a href="seller.php" class="back-button">Back</a>
    <section class="add-product">
        <h2>User Signup</h2>
        <form action="signup.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="age">Age:</label>
            <input type="number" id="age" name="age" required>

            <label>Gender:</label>
            <div style="display:flex">
                <label for="male">Male</label>
                <input type="radio" id="male" name="gender" value="male" required>
                <label for="female">Female</label>
                <input type="radio" id="female" name="gender" value="female" required>
            </div>
            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea>

            <div class="profile-actions">
                <button type="submit" name="signup">Sign Up</button>
            </div>
            <?php if (!empty($successMessage)): ?>
                <div class="centered-message">
                    <?php echo $successMessage; ?>
                </div>
            <?php endif; ?>
            <br>
            <a href="login.php" class="cta-link">Login</a>

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