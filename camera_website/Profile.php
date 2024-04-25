<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shutterspace";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_COOKIE['email'])) {
    $email = $_COOKIE['email'];

    $userQuery = "SELECT * FROM user WHERE email='$email'";
    $userResult = mysqli_query($conn, $userQuery);

    if (mysqli_num_rows($userResult) > 0) {
        $user = mysqli_fetch_assoc($userResult);

        $name = $user['username'];
        $age = $user['age'];
        $gender = $user['gender'];
        $address = $user['address'];
    } else {
        echo "User not found in the database.";
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update'])) {
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);

        $updateQuery = "UPDATE user 
                    SET username='$name', age='$age', gender='$gender', address='$address' 
                    WHERE email='$email'";

        if (mysqli_query($conn, $updateQuery)) {
            echo '<script>alert("User details updated successfully");</script>';
            $successMessage = "User details updated successfully";
        } else {
            echo '<script>alert("ERROR");</script>';
            $errorMessage = "Error updating user details: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['delete'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $deleteQuery = "DELETE FROM user WHERE email='$email'";

        if (mysqli_query($conn, $deleteQuery)) {
            echo '<script>alert("User deleted successfully");</script>';
            setcookie("email", "", time() - 3600, "/");
            header("Location: login.php");
            exit();
        } else {
            echo '<script>alert("ERROR");</script>';
        }
    }
}

if (isset($_POST['logout'])) {
    setcookie("email", "", time() - 3600, "/");
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
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
        <?php
        if (isset($email)) {
            echo '<h2>User Profile</h2>
                <form action="profile.php" method="post">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="' . $name . '" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="' . $email . '" required readonly>

                    <label for="age">Age:</label>
                    <input type="number" id="age" name="age" value="' . $age . '" required>

                    <label for="gender">Gender:</label>
                    <div style="display:flex">
                        <label for="male">Male</label>';
                        if($gender == "male")
                            echo    '<input type="radio" id="male" name="gender" value="Male" checked required>';
                        else
                            echo    '<input type="radio" id="male" name="gender" value="Male" required>';

                    echo    '<label for="female">Female</label>';
                    if($gender == "female")
                        echo '<input type="radio" id="female" name="gender" value="Female" checked required>';
                    else
                        echo '<input type="radio" id="female" name="gender" value="Female" required>';
                    echo '</div>
                    <label for="address">Address:</label>
                    <textarea id="address" name="address" required>' . $address . '</textarea>

                    <div class="profile-actions">
                        <button type="submit" name="update">Update Profile</button>
                        <button type="submit" name="delete" onclick="return confirm(\'Are you sure you want to delete your profile?\')">Delete Profile</button>
                    </div>
                </form> <br>';
            echo '<form action="profile.php" method="post">
                        <button type="submit" name="logout">Logout</button>
                      </form>';
        } else {
            echo '<div class="signup-buttons">';
            echo '<a class="cta-link" href="Signup.php" target="_blank" style="margin-right:6%">Sign Up</a>';
            echo '<a class="cta-link" href="Login.php" target="_blank">Login</a>';
            echo '</div>';
        }
        ?>
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