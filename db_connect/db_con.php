<?php
$encrypt_key = '19boTyyrn88configurationAESkl*9';
$servername = "localhost";
$usernames = "root";
$passwords = "";
try {
  $conn = new PDO("mysql:host=$servername;dbname=synrgise", $usernames, $passwords);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
?>