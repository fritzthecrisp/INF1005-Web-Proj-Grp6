<?php
// Include the configuration for database connection
include 'config/db.php'; // Adjust this path to where your database configuration file is located

// Retrieve user inputs
$uname = $_POST['uname'] ?? '';
$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$email = $_POST['email'] ?? '';
$gender = $_POST['gender'] ?? '';
$dob = $_POST['dob'] ?? '';
$weight = $_POST['weight'] ?? '';
$pwd = $_POST['pwd'] ?? '';
$pwd_confirm = $_POST['pwd_confirm'] ?? '';


// Simple validation
if (empty($uname) || empty($fname) || empty($lname) || empty($email) || empty($dob) || empty($pwd) || empty($pwd_confirm) || $pwd !== $pwd_confirm) {
    // Handle error - for example, redirect back to form with a message
    exit('Invalid input or passwords do not match.');
}

// Password hashing using bcrypt
$hashed_password = password_hash($pwd, PASSWORD_BCRYPT);

// SQL statement
$sql = "INSERT INTO users (user_username, user_password, user_fname, user_lname, user_email, user_sex, user_dob, user_weight) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

// Bind Params
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $uname);
$stmt->bindParam(2, $hashed_password);
$stmt->bindParam(3, $fname);
$stmt->bindParam(4, $lname);
$stmt->bindParam(5, $email);
$stmt->bindParam(6, $gender);
$stmt->bindParam(7, $dob);
$stmt->bindParam(8, $weight);
$stmt->execute();

// Handle execution
if ($stmt->rowCount() > 0) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn = null;

?>
