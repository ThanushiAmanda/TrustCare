<?php

$conn = mysqli_connect('localhost','root','','trustcare_db') or die('connection failed');

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $date = $_POST['date'];

   $insert = mysqli_query($conn, "INSERT INTO `contact_form`(name, email, number, date) VALUES('$name','$email','$number','$date')") or die('query failed');

   if($insert){
      $message[] = 'appointment made successfully!';
   }else{
      $message[] = 'appointment failed';
   }

}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="appointment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>TrustCare</title>
</head>
<body>
    <header class="header">

        <a href="#" class="logo"> <img src="./images/logo.png" alt=""> <strong>Trust</strong>care </a>
    
        <nav class="navbar">
            <a href="#home">home</a>
            <a href="./pages/About.html" target="_self">about</a>
            <a href="./pages/services.html">services</a>
            <a href="#doctors">doctors</a>
            <a href="#appointment">appointment</a>
            <a href="#review">review</a>
            <a href="./pages/blogs.html">blogs</a>
        </nav>
    
        <div id="menu-btn" class="fas fa-bars"></div>
    
    </header>

    


    <section class="appointment" id="appointment">

        <h1 class="heading"> <span>appointment</span> now </h1>    
    
        <div class="row">
    
            <div class="image">
                <img src="images/16.png" alt="">
            </div>
    
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            
          
                <h3>make appointment</h3>
                <input type="text"name="name" placeholder="your name" class="box">
                <input type="number"name="number" placeholder="your number" class="box">
                <input type="email"name="email" placeholder="your email" class="box">
                <input type="date"name="date" class="box">
                <input type="submit" name="submit" value="appointment now" class="btn">
            </form>
    
        </div>
    
    </section>


    <footer class="footer">

        <div class="box-container">
    
            <div class="box">
                <h3>quick links</h3>
                <a href="#home"> <i class="fas fa-chevron-right"></i> home </a>
                <a href="#about"> <i class="fas fa-chevron-right"></i> about </a>
                <a href="#services"> <i class="fas fa-chevron-right"></i> services </a>
                <a href="#doctors"> <i class="fas fa-chevron-right"></i> doctors </a>
                <a href="#appointment"> <i class="fas fa-chevron-right"></i> appointment </a>
                <a href="#review"> <i class="fas fa-chevron-right"></i> review </a>
                <a href="#blogs"> <i class="fas fa-chevron-right"></i> blogs </a>
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