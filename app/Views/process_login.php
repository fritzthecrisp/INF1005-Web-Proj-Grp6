<?php
session_start();
// Include the database connection file
include 'config/db.php';

// Retrieve email and password from the form
$email = $_POST['email'] ?? '';
$pwd = $_POST['pwd'] ?? '';

// Validate the input
if (empty($email) || empty($pwd)) {
    // Handle error - for example, redirect back to the login form with a message
    exit('Please enter email and password.');
}

// Prepare SQL statement to select the user
$sql = "SELECT user_id, user_password FROM users WHERE user_email = :email LIMIT 1";
$stmt = $conn->prepare($sql);

// Execute with bound parameters
$stmt->execute([':email' => $email]);

// Fetch the user
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if user exists and password is correct
if ($user && password_verify($pwd, $user['user_password'])) {
    // Password is correct, so start a new session and save the user's ID in the session
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['logged_in'] = time(); // You can record the login time

    // Redirect to a new page or display a success message
    header("Location: success.php"); // Replace with the page you want to redirect to
    exit;
} else {
    // Handle error - for example, redirect back to the login form with a message
    exit('Login failed. Please check your email and password.');
}

// Close the connection
$conn = null;
?>