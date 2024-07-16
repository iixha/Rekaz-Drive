<?php

$host = 'localhost'; 
$dbname = 'rekaz_drive'; 
$username = 'root'; 
$password = '0531419061'; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         echo "The database was connected successfully";
} catch (PDOException $e) {
    die("The connection to the database failed" . $e->getMessage());
}
?> 
