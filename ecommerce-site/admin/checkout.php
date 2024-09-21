<?php
session_start();

// Simulating a cart for demonstration. Replace this with actual cart retrieval logic.
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$total = 0;

// Calculate total price
foreach ($cart as $item) {
    $total += $item['price'] * $item['quantity'];
}

// Handle form submission for the checkout
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get shipping info from the form
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];

    // Here, you would normally process the payment and save the order to the database.
    // For this example, we'll just clear the cart and show a success message.
    unset($_SESSION['cart']);
    $success_message = "Merci, $name! Votre commande a été reçue.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .container {
            max-width: 800px;
            margin-top: 40px;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            background-color: white;
            padding: 30px;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .alert {
            border-radius: 8px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #343a40;
            color: white;
            position: fixed;
            width: calc(100% - 0px);
            bottom: 0;
        }
    </style>
</head>
<body>
  <!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/ecommerce-site/index.php">Votre Boutique</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="https://localhost:8443/ecommerce-site/index.php">Déconnexion</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
    <div class="card">
        <h2>Checkout</h2>

        <!-- Message de succès -->
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>

        <h4>Votre panier</h4>
        <ul class="list-group mb-3">
            <?php if (empty($cart)): ?>
                <li class="list-group-item">Votre panier est vide.</li>
            <?php else: ?>
                <?php foreach ($cart as $item): ?>
                    <li class="list-group-item">
                        <?php echo htmlspecialchars($item['name']); ?> 
                        <span class="badge bg-primary"><?php echo $item['quantity']; ?> × <?php echo number_format($item['price'], 2); ?> €</span>
                    </li>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>

        <h4>Total: <?php echo number_format($total, 2); ?> €</h4>

        <form method="POST">
            <h4>Informations de livraison</h4>
            <div class="mb-3">
                <label for="name" class="form-label">Nom complet</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>

            <div class="mb-3">
                <label for="city" class="form-label">Ville</label>
                <input type="text" class="form-control" id="city" name="city" required>
            </div>

            <div class="mb-3">
                <label for="zip" class="form-label">Code postal</label>
                <input type="text" class="form-control" id="zip" name="zip" required>
            </div>

            <button type="submit" class="btn btn-primary">Passer la commande</button>
        </form>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="text-center">
        © 2024 Votre Boutique. Tous droits réservés.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
