<?php
$servername = "localhost";
$username = "root";  // Nom d'utilisateur de la base de données
$password = "";      // Mot de passe de la base de données
$dbname = "ecommerce_db"; // Nom de votre base de données

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
?>
