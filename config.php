<?php
// Configuration for the database connection
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'mz8d23t_STU85937');
define('DB_PASSWORD', 'ArdenLondon123');
define('DB_NAME', 'mz8d23t_QuizByteDB');

// Create a new MySQLi connection
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check if the connection was successful
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Return the database connection object
    return $conn;