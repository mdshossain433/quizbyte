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
    <link rel="stylesheet" href="css/indexStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
     <!-- JavaScript -->
    <script src="js/indexScript.js"></script>
    
     <!-- The title of the webpage -->
    <title>QuizByte</title>
</head>

<body>
    <!--Header-->
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

    <!-- Hero Section -->
    <div class="hero-section">
        <!-- Welcome message and play button -->
        <h1>Welcome to QuizByte: Your Gateway to Interactive Learning!</h1>
       <a href="quiz.php">
        <button>Let's Play</button></a>  
    </div>

     <!-- Details Section -->
    <div class="details-section">
        <div>
           <!-- Description of QuizByte -->
            <p>QuizByte is a web interface for a multiple-choice quiz application. It offers a wide range of topics to choose from and provides an engaging quiz experience.<br> Our interactive quizzes are tailored exclusively for computer science enthusiasts. Whether you're a student brushing up for exams, a professional keeping your skills sharp, or simply a curious mind delving into programming and technology, QuizByte is your perfect quiz companion. Our platform offers a user-friendly interface, dynamic question presentation, and an extensive question bank dedicated solely to computer science. Each quiz you embark on is a new journey through the fascinating realms of computing, programming languages, algorithms, and much more.</p>
        </div>
        <img src="Images/QuizByte.png" alt="QuizByte" style="max-height: 300px;">
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <h2>Dive into a World of Knowledge with QuizByte</h2>
        <!-- Features cards -->
        <div class="feature-card">
            <h3>Multiple-Choice Questions</h3>
            <p>Our quiz offers an extensive array of multiple-choice questions designed to test and expand your knowledge in computing and technology comprehensively.</p>
        </div>
        <div class="feature-card">
        <h3>Randomised Question & Answer Order</h3>
        <p>Both questions and their respective answers are randomised each time, offering a truly unique challenge on every attempt.</p>
        </div>
        <div class="feature-card">
        <h3>Answer Review & Edit</h3>
        <p>Empower your learning journey by reviewing and editing answers at any point before the final submission, enhancing accuracy and learning outcomes.</p>
        </div>
        <div class="feature-card">
            <h3>High Score Tracking</h3>
            <p>Keep track of the top 5 players with the highest scores.</p>
        </div>
    </div>
    
   <!--Footer-->
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