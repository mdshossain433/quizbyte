<?php
// Start a session if not already started
if (!session_id()) {
    session_start();
}
?>

<nav class="navbar">
    <!-- Hamburger button for mobile navigation -->
    <button class="hamburger" aria-label="Open navigation menu">
        <i class="fas fa-bars"></i> <!-- Original hamburger icon -->
        <i class="fas fa-times" style="display: none;"></i> <!-- Cross icon, hidden by default -->
    </button>

    <!-- Navigation links -->
    <div class="nav-links">
        <ul>
            <li><a href="index.php" class="navbar-item">Home</a></li>
            <li><a href="scoreboard_display.php" class="navbar-item">Scoreboard</a></li>
            <li><a href="instructions.php" class="navbar-item">Instructions</a></li>
            <li><a href="about.php" class="navbar-item">About</a></li>
            <?php
            // Check if user is logged in
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                echo '<li><a href="profile_form.php" class="navbar-item">My Profile</a></li>';
                echo '<li><a href="php/logout.php" class="navbar-item">Logout</a></li>';
            } else {
                echo '<li><a href="login_form.php" class="navbar-item">Login</a></li>';
                echo '<li><a href="register_form.php" class="navbar-item">Register</a></li>';
            }
            ?>
        </ul>
    </div>
</nav>
