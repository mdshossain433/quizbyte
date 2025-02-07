<?php
// Start a PHP session to manage user sessions and data
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/aboutStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- JavaScript -->
    <script src="js/aboutScript.js"></script>
    
     <!-- The title of the webpage -->
    <title>QuizByte</title>
   
</head>

<body>

<!-- Header Section -->
<div class="header">
  <!-- QuizByte logo -->
  <img src="Images/QuizByteLogo.png" id="header-logo" alt="QuizByte Logo" style="max-height: 100px;">
  <!-- Title container -->
  <div class="title-container">
    <h1>QuizByte</h1>
    <h2>Innovate, Iterate, Inspire</h2>
  </div>
</div>

<!-- Include navigation bar -->
<?php include 'php/navbar.php'; ?>

<!-- About Section -->
<section class="about-section">
    <!-- Introduction -->
    <h1>Join the QuizByte Community</h1>
    <p>Embark on your journey of discovery and fun today and step into the world of QuizByte - where learning meets excitement!</p>

    <!-- Who We Are -->
    <h2>Welcome to the Heart of QuizByte!</h2>
    <h3>Who We Are</h3>
    <p>We are a team of passionate educators, developers, and quiz enthusiasts based in London, dedicated to creating an innovative and interactive learning experience through our multiple-choice quiz web application, QuizByte.</p>

    <!-- Our Vision -->
    <h3>Our Vision</h3>
    <p>At QuizByte, we strive to make learning accessible, engaging, and fun for everyone. We believe in the power of knowledge and the joy of learning, and our mission is to create a platform that brings these elements together seamlessly.</p>

    <!-- Our Approach -->
    <h3>Our Approach</h3>
    <ul>
        <li>User-Centric Design: We focus on creating a smooth, intuitive user experience with a clean, responsive interface.</li>
        <li>Engaging Content: Our quizzes are carefully curated to offer challenge and entertainment.</li>
        <li>Technological Innovation: We ensure a seamless and dynamic quizzing experience using the latest web technologies.</li>
        <li>Community and Competition: Our leaderboard and scoring system adds a competitive edge to learning.</li>
    </ul>

    <p>At QuizByte, we're more than just a quiz platform; we're a community of learners and dreamers. We invite you to join us on this exciting journey of learning and growth. Let's make learning an adventure together!</p>

    <!-- Contact Us -->
    <h3>Contact Us</h3>
    <p>QuizByte Ltd.<br>
    123 Mile End Road<br>
    E1 2AB<br>
    London, UK<br>
    Email: support@quizbyte.com</p>
</section>

<!-- FAQ Section -->
<section class="faq-section">
    <h3>Frequently Asked Questions</h3>
    <div class="faq" id="faq-container">
    </div>
</section>

<!-- Footer Section -->
<footer class="footer">
    <!-- Wave animations -->
    <div class="wave-container">
        <div class="wave" id="wave1"></div>
        <div class="wave" id="wave2"></div>
        <div class="wave" id="wave3"></div>
        <div class="wave" id="wave4"></div>
    </div>
    <!-- Social media links -->
    <div class="social">
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-tiktok"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
    </div>

     <!-- Footer links -->
     <ul class="footer-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <!-- Display "Logout" link if user is logged in, otherwise display "Login" and "Register" links -->
        <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true): ?>
            <li><a href="php/logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login_form.php">Login</a></li>
            <li><a href="register_form.php">Register</a></li>
        <?php endif; ?>
        <li><a href="scoreboard_display.php">Scoreboard</a></li>
    </ul>
    
     <!-- Footer section -->
    <div class="footer-section">
        <p>&copy; 2024 STU85937- All Rights Reserved.</p>
    </div>
</footer>

</body>
</html>

