<?php
session_start();

// Vérification du rôle de l'utilisateur (administrateur)
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

include '../includes/db.php';

$id = $_GET['id'];

// Récupérer les détails de la commande
$query = $conn->prepare("SELECT * FROM orders WHERE id = ?");
$query->bind_param('i', $id);
$query->execute();
$order = $query->get_result()->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];

    // Mettre à jour le statut de la commande
    $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
    $stmt->bind_param('si', $status, $id);
    $stmt->execute();

    echo "Statut mis à jour avec succès !";
    header("Location: manage_orders.php");
    exit;
}
?>

<h1>Modifier le statut de la commande #<?php echo $id; ?></h1>
<form action="update_order_status.php?id=<?php echo $id; ?>" method="POST">
    <label for="status">Statut :</label>
    <select id="status" name="status">
        <option value="En cours" <?php if ($order['status'] == 'En cours') echo 'selected'; ?>>En cours</option>
        <option value="Expédiée" <?php if ($order['status'] == 'Expédiée') echo 'selected'; ?>>Expédiée</option>
        <option value="Livrée" <?php if ($order['status'] == 'Livrée') echo 'selected'; ?>>Livrée</option>
        <option value="Annulée" <?php if ($order['status'] == 'Annulée') echo 'selected'; ?>>Annulée</option>
    </select><br>

    <input type="submit" value="Mettre à jour">
</form>

<a href="manage_orders.php">Retour à la gestion des commandes</a>
