<?php
session_start();

// Check if the user is logged in (based on your session variable)
if (isset($_SESSION['admin'])) {
    // Debug: Print the value of the admin session variable
    echo "Admin session variable is set: " . $_SESSION['admin'];

    // Unset or destroy the session variables
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session

    // Redirect to the login page or any other page you want after logout
    header('Location: login.php'); // Change 'login.php' to your login page URL
    exit();
} else {
    // If the user is not logged in, you can handle this case differently
    echo "You are not logged in.";
}

?>
