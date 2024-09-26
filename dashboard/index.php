<?php
session_start();
require '../config.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../login/index.php");
    exit();
}

$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $review_text = $_POST['review_text'];
    $rating = $_POST['rating'];
    $photo = '';

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $photo = basename($_FILES["photo"]["name"]);
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $stmt = $conn->prepare("INSERT INTO reviews (username, review_text, rating, photo) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $username, $review_text, $rating, $photo);

    if ($stmt->execute()) {
        echo "Review added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$reviews = $conn->query("SELECT * FROM reviews ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
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

<div class="dash-container">
        <p class="greet" >Welcome, <?php echo $username; ?>!</p>
        <p><a href="../logout.php">Logout</a></p>

        <h3>Add Review</h3>
        <form method="POST" action="" enctype="multipart/form-data">
            <label for="review_text">Review:</label>
            <textarea id="review_text" name="review_text" required></textarea>
            <br>
            <label for="rating">Rating (1-5):</label>
            <select id="rating" name="rating" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <br>
            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo">
            <br>
            <button type="submit">Add Review</button>
        </form>

        <div class="reviews-container">
    <?php while($row = $reviews->fetch_assoc()): ?>
        <div class="review">
            <p><strong><?php echo $row['username']; ?></strong></p>
            <p>Rating: <?php echo $row['rating']; ?></p>
            <p><?php echo $row['review_text']; ?></p>
            <?php if ($row['photo']): ?>
                <p><img src="../uploads/<?php echo $row['photo']; ?>" alt="Review Photo"></p>
            <?php endif; ?>
            <p><em><?php echo $row['created_at']; ?></em></p>
        </div>
    <?php endwhile; ?>
</div>
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
        <p>&copy; 2024 <span>TrustCare Hospital</span> | All rights reserved.</p></div>
    
    </footer>
</body>
</html>
