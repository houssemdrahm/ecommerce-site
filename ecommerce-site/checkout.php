<?php
session_start();

// Vérifiez si le panier n'est pas vide
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit;
}

include '../includes/header.php';
include '../includes/db.php';

// Si le formulaire de commande a été soumis
if (isset($_POST['place_order'])) {
    // Récupérer les détails de l'utilisateur (simulé ici, mais pourrait venir d'une session utilisateur après connexion)
    $user_id = $_SESSION['user_id'];
    $address = $_POST['address'];
    $payment_method = $_POST['payment_method']; // Ex: "carte", "paypal"

    // Insérer la commande dans la table 'orders'
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, address, payment_method) VALUES (?, ?, ?, ?)");
    $total_price = calculateTotalPrice($_SESSION['cart']); // Fonction pour calculer le prix total
    $stmt->bind_param('idss', $user_id, $total_price, $address, $payment_method);
    $stmt->execute();
    $order_id = $stmt->insert_id; // Récupérer l'ID de la commande

    // Insérer chaque produit dans la table 'order_items'
    foreach ($_SESSION['cart'] as $product_id => $product) {
        $stmt = $conn->prepare("INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('iiid', $order_id, $product_id, $product['quantity'], $product['price']);
        $stmt->execute();
    }

    // Vider le panier
    unset($_SESSION['cart']);

    // Redirection vers la page de confirmation
    header("Location: confirmation.php?order_id=" . $order_id);
    exit;
}

function calculateTotalPrice($cart) {
    $total = 0;
    foreach ($cart as $product) {
        $total += $product['price'] * $product['quantity'];
    }
    return $total;
}
?>

<h1>Validation de la commande</h1>

<h2>Récapitulatif du panier</h2>

<table>
    <thead>
        <tr>
            <th>Produit</th>
            <th>Prix</th>
            <th>Quantité</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php $total = 0; ?>
        <?php foreach ($_SESSION['cart'] as $product_id => $product): ?>
        <tr>
            <td><?php echo $product['name']; ?></td>
            <td><?php echo $product['price']; ?> €</td>
            <td><?php echo $product['quantity']; ?></td>
            <td><?php echo $product['price'] * $product['quantity']; ?> €</td>
        </tr>
        <?php $total += $product['price'] * $product['quantity']; ?>
        <?php endforeach; ?>
    </tbody>
</table>

<h3>Total à payer : <?php echo $total; ?> €</h3>

<!-- Formulaire pour compléter la commande -->
<form action="checkout.php" method="POST">
    <label for="address">Adresse de livraison :</label><br>
    <textarea id="address" name="address" required></textarea><br><br>

    <label for="payment_method">Méthode de paiement :</label><br>
    <select id="payment_method" name="payment_method" required>
        <option value="card">Carte de crédit</option>
        <option value="paypal">PayPal</option>
    </select><br><br>

    <button type="submit" name="place_order">Passer la commande</button>
</form>

<a href="cart.php">Modifier le panier</a>

<?php include '../includes/footer.php'; ?>
