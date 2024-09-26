<?php
session_start();
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check if username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo "Username already taken. Please choose another one.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            $_SESSION['username'] = $username;
            header("Location: ../dashboard/index.php");
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Signup</title>
</head>
<body>

<header class="header">
    <a href="#" class="logo"> <img src="../images/logo.png" alt=""> <strong>Trust</strong>care </a>
    <nav class="navbar">
        <a href="#home">home</a>
        <a href="./pages/About.html" target="_self">about</a>
        <a href="./pages/services.html">services</a>
        <a href="./doctors.php">doctors</a>
        <a href="./appoinment.php">appointment</a>
        <a href="#review">review</a>
        <a href="./pages/blogs.html">blogs</a>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
</header>

<div class="login">
    <h2>Login</h2>
    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="Login">Login</button>
    </form>
    <p>Create an Account <a href="../signup/index.php">Signup Here</a></p>
</div>

<footer class="footer">
    <div class="box-container">
        <div class="box">
            <h3>quick links</h3>
            <a href="#home"> <i class="fas fa-chevron-right"></i> home </a>
            <a href="./pages/About.html"> <i class="fas fa-chevron-right"></i> about </a>
            <a href="./pages/Services.html"> <i class="fas fa-chevron-right"></i> services </a>
            <a href="./doctors.php"> <i class="fas fa-chevron-right"></i> doctors </a>
            <a href="./appoinment.php"> <i class="fas fa-chevron-right"></i> appointment </a>
            <a href=""> <i class="fas fa-chevron-right"></i> review </a>
            <a href="./pages/blogs.html"> <i class="fas fa-chevron-right"></i> blogs </a>
        </div>
        <div class="box">
            <h3>our services</h3>
            <a href="#"> <i class="fas fa-chevron-right"></i> dental care </a>
            <a href="#"> <i class="fas fa-chevron-right"></i> message therapy </a>
            <a href="#"> <i class="fas fa-chevron-right"></i> cardioloty </a>
            <a href="#"> <i class="fas fa-chevron-right"></i> diagnosis </a>
            <a href="#"> <i class="fas fa-chevron-right"></i> ambulance service </a>
        </div>
        <div class="box">
            <h3>appointment info</h3>
            <a href="#"> <i class="fas fa-phone"></i> +8801688238801 </a>
            <a href="#"> <i class="fas fa-phone"></i> +8801782546978 </a>
            <a href="#"> <i class="fas fa-envelope"></i> wincoder9@gmail.com </a>
            <a href="#"> <i class="fas fa-envelope"></i> sujoncse26@gmail.com </a>
            <a href="#"> <i class="fas fa-map-marker-alt"></i> sylhet, bangladesh </a>
        </div>
        <div class="box">
            <h3>follow us</h3>
            <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
            <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
            <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
            <a href="#"> <i class="fab fa-pinterest"></i> pinterest </a>
        </div>
    </div>
    <div class="credit">
        <p>&copy; 2024 <span>TrustCare Hospital</span> | All rights reserved.</p>
    </div>
</footer>

<script>
    const menuBtn = document.getElementById('menu-btn');
    const navbar = document.querySelector('.navbar');
    
    menuBtn.addEventListener('click', () => {
        navbar.classList.toggle('active');
    });
</script>
</body>
</html>

