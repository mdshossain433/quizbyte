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
    <link rel="stylesheet" href="css/instructionsStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- JavaScript -->
    <script src="js/instructionsScript.js"></script>
    
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

<!-- Instructions Section -->
<section class="instructions-section">
    <!-- Section Title -->
    <h2>How to Play</h2>
    
    <!-- Introduction Text -->
    <p>Welcome to QuizByte, the ultimate Computer Science quiz challenge! Here's how you can play and score big:</p>
    
    <!-- List of Instructions -->
    <ol class="instruction-list">
        <li><strong>Registration and Login:</strong> First, register and log in to start the quiz.</li>
        <li><strong>Quiz Format:</strong> The quiz consists of 20 random questions about Computer Science.</li>
        <li><strong>Scoring:</strong> Each correct answer earns you 5 points.</li>
        <li><strong>Time Limit:</strong> You have 20 seconds to answer each question.</li>
        <li><strong>Submission:</strong> Answer all questions before submitting. If time runs out, you cannot submit and will score zero.</li>
        <li><strong>Total Score:</strong> Your total score is a combination of correct answers and bonus points for speed.</li>
    </ol>
    
    <!-- Collapsible Bonus Points Explanation -->
    <button id="bonusPointsToggle" class="faq-collapsible">How Bonus Points Work</button>
    <div class="content" style="display:none;">
         <p> Bonus points in the quiz reward both accuracy and speed. If you answer all questions correctly, you'll earn extra points based on the time you have left. The formula is simple: the quicker you complete the quiz with all correct answers, the higher the bonus points you receive. That means speed is crucial—think fast and answer smartly to maximise your score. The faster you finish, the more bonus points you add to your total, rewarding your swift thinking and accuracy.</p>
    </div>
    
    <!-- Closing Remark -->
    <p>Good luck, and may the fastest mind win!</p>
</section>

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
