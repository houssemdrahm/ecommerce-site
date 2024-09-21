<?php
session_start();

// Détruire la session
session_unset(); // Libérer toutes les variables de session
session_destroy(); // Détruire la session

// Rediriger vers la page d'accueil ou de connexion
header("Location: https://localhost:8443/ecommerce-site/index.php"); // ou "login.php" selon votre structure
exit;
?>
