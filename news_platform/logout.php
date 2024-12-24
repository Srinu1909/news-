<?php
session_start();

// If the user has confirmed logout
if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
    session_unset();  // Unset all session variables
    session_destroy(); // Destroy the session

    // Redirect to the login page
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
    <script>
        // JavaScript confirmation dialog
        function confirmLogout() {
            // Show a confirmation dialog
            const userConfirmed = confirm("Are you sure you want to log out?");
            if (userConfirmed) {
                // If the user confirms, redirect with a query string to confirm logout
                window.location.href = "logout.php?confirm=yes";
            } else {
                // If the user cancels, just redirect back to the homepage or any other page
                window.location.href = "index.php"; // Change this to your homepage or a dashboard
            }
        }
    </script>
</head>
<body>
    <h1>Logout</h1>
    <p>Click the button below to log out.</p>
    <button onclick="confirmLogout()">Log Out</button>
</body>
</html>
