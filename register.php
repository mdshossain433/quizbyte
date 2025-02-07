<?php
// Start a session if not already started
if (!isset($_SESSION)) {
    session_start();
}

// Include config file
$conn = require 'config.php';

// Define variables and initialise with empty values
$name = $username = $password = $email = $confirm_password = "";
$name_err = $username_err = $password_err = $email_err = $confirm_password_err = "";

// Check if the request is for checking username/email uniqueness
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'check_uniqueness') {
    $response = ['username' => '', 'email' => ''];

    // Check username uniqueness
    if (!empty($_POST['username'])) {
        $sql = "SELECT UserID FROM Users WHERE Username = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $_POST['username']);
            if ($stmt->execute()) {
                $stmt->store_result();
                $response['username'] = $stmt->num_rows > 0 ? 'taken' : 'available';
            }
            $stmt->close();
        }
    }

    // Check email uniqueness
    if (!empty($_POST['email'])) {
        $sql = "SELECT UserID FROM Users WHERE Email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $_POST['email']);
            if ($stmt->execute()) {
                $stmt->store_result();
                $response['email'] = $stmt->num_rows > 0 ? 'taken' : 'available';
            }
            $stmt->close();
        }
    }

    // Return the response in JSON format and exit
    echo json_encode($response);
    exit;
}

// Continue with the registration process if not an AJAX request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        $sql = "SELECT UserID FROM Users WHERE username = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = trim($_POST["username"]);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }

    // Validate Email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } else {
        $sql = "SELECT UserID FROM Users WHERE email = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_email);
            $param_email = trim($_POST["email"]);
            if ($stmt->execute()) {
                $stmt->store_result();
                if ($stmt->num_rows == 1) {
                    $email_err = "This email is already taken.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            $stmt->close();
        }
    }


   // Validate password
if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter a password.";     
} elseif (!preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[\W]).{6,}$/', trim($_POST["password"]))) {
    $password_err = "Password must have at least 6 characters, including at least one number, one lowercase letter, one uppercase letter, and one special character.";
} else {
    $password = trim($_POST["password"]);
}


    // Validate confirm password
    if (empty(trim($_POST["confirmPassword"]))) {
        $confirm_password_err = "Please confirm the password.";     
    } else {
        $confirm_password = trim($_POST["confirmPassword"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting into the database
    if (empty($name_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err)) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare an insert statement
       $sql = "INSERT INTO Users (Name, Username, Password, Email) VALUES (?, ?, ?, ?)";

        
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssss", $param_name, $param_username, $param_password, $param_email);
            
            // Set parameters
            $param_name = $name;
            $param_username = $username;
            $param_password = $hashed_password;
            $param_email = $email;
            
           // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page
                header("location: ../login_form.php");
                exit; // Make sure no further code is run after a redirect
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
}
