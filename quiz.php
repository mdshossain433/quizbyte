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
    <link rel="stylesheet" href="css/quizStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- JavaScript -->
    <script src="js/quizScript.js"></script>
    
    <!-- The title of the webpage -->
    <title>QuizByte</title>
</head>
<body>

<!-- Header -->
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

<!-- Display message if user is not logged in -->
<?php if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) : ?>
    <p>You must be logged in to take the quiz. Please <a href="login_form.php">log in</a> or <a href="register_form.php">register</a>.</p>
<?php else : ?>

    <button id="startButton" onclick="startQuiz()">Start Quiz</button>
    <form id="quizForm" method="post" action="php/submit_score.php" style="display: none;">
        <!-- Quiz questions will be dynamically inserted here -->

        <!-- Navigation buttons -->
        <div class="navigation-buttons">
            <button type="button" id="prevButton" onclick="showPrevQuestion()" style="display: none;">Previous</button>
            <button type="button" id="nextButton" onclick="showNextQuestion()">Next</button>
        </div>

        <!-- Hidden input to store quiz score -->
        <input type="hidden" name="score" id="quizScore">
        <!-- Submit button -->
        <button type="button" id="submitButton" onclick="submitQuiz()" style="display: none;">Submit</button>
    </form>
    
    <!-- Quiz results display -->
    <div id="results"></div>
    
<?php endif; ?>

<!-- Footer -->
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
