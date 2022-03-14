<?php

// NB: connection to phpmyadmin database
$servername = "localhost";
$username = "root";
$password = "";

// NB: connecting to the created database "jobportal"
$dbname = "jobportal";

// Create connection
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);  
  //echo "Connected successfully";
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>