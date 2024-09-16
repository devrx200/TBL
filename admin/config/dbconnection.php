<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
  // Local database configuration
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'tbl_db');
} else {
  // Server database configuration
  define('DB_HOST', 'localhost');
  define('DB_USER', 'tbl_db');
  define('DB_PASS', 'cbktech@1A');
  define('DB_NAME', 'tbl_db');
}
// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
} else {
  include('function.php');
}
// echo "Connected successfully";