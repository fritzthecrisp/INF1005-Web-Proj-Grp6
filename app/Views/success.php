<?php
include "inc/head.inc.php";
include "inc/nav.inc.php";
// Check if the user is not logged in, if not then redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Success - One-stop Fitness</title>
</head>
<body>
    <main class="container">
        <h1>Welcome to One-stop Fitness</h1>
        <p>Congratulations, you have successfully logged in to our system!</p>

        <p><a href="logout.php" class="btn btn-primary">Logout</a></p>
    </main>
    <?php
    // Include the footer
    include "inc/footer.inc.php";
    ?>
</body>
</html>