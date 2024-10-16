<?php
session_start();

// Check if the user is logged in
if (!(isset($_SESSION["login1"]) && $_SESSION["login1"])) {
    // Redirect to login1.php if not logged in
    header("Location: login1.php");
    exit;
}

// Log the user out
session_unset();
session_destroy();

// Redirect to login1.php after logout
header("Location: login1.php");
exit;
?>
