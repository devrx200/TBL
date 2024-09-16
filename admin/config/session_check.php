<?php
session_start();

$timeout_duration = 10800; // 3 hours in seconds

// Check if the session has expired
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    // Session has expired
    session_unset();
    session_destroy();
    header('Location: ../index.php');
    exit();
}

// Update last activity time
$_SESSION['last_activity'] = time();

// Check if user is logged in and has the correct role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    // Redirect to login page if the user is not logged in or not an admin
    header('Location: ../index.php');
    exit();
}
