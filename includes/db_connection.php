<?php
define("DB_SERVER", "localhost");
define("DB_USER", "prashant729");
define("DB_PASS", "25nov1992");
define("DB_NAME", "cambuzz");

// Create connection
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
?>