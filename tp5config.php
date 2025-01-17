<?php
// Parametres de connexion
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "ecommerce";

// Connexion à la base de donnees
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Verifier la connexion
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
