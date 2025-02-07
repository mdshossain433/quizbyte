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
    <link rel="stylesheet" href="css/scoreboardStyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- JavaScript -->
    <script src="js/scoreboardScript.js"></script>
   
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

 <!-- Scoreboard Section -->
    <section class="scoreboard-section">
        <h2 class="scoreboard-title">Top 5 Players</h2>
        <!-- Display top scores dynamically -->
        <ul class="scoreboard" id="dynamicScoreboard">
            <?php foreach ($topScores as $score): ?>
                <li class="player">
                    <!-- Display player's username -->
                    <span class="player-name"><?= htmlspecialchars($score['Username']) ?></span>
                    <!-- Display player's score -->
                    <span class="player-score">Score: <?= htmlspecialchars($score['Score']) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
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
