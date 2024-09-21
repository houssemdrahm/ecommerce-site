<?php
session_start();
include '../includes/header.php';

$order_id = $_GET['order_id']; // Récupérer l'ID de la commande

?>

<h1>Commande confirmée</h1>

<p>Merci pour votre commande ! Votre commande numéro <?php echo $order_id; ?> a été validée.</p>

<p><a href="index.php">Retour à la boutique</a></p>

<?php include '../includes/footer.php'; ?>
