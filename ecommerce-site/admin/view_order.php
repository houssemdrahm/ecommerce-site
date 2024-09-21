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

// Vérification si la commande existe
if (!$order) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Commande non trouvée</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                background-color: #f5f7fa;
            }
            .error-container {
                text-align: center;
                margin-top: 100px;
            }
            .card {
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                padding: 20px;
                margin-top: 30px;
                max-width: 600px;
                margin: auto;
            }
            .error-message {
                font-size: 1.5rem;
                font-weight: bold;
                color: #ff4d4d;
            }
            .dashboard-content {
                padding: 40px;
                margin-left: 250px;
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

    <div class="dashboard-content">
        <div class="container error-container">
            <div class="card">
                <h1 class="error-message">Commande non trouvée</h1>
                <p>Nous sommes désolés, mais la commande que vous recherchez n'existe pas ou a été supprimée.</p>
                <a href="manage_orders.php" class="btn btn-primary">Retour à la gestion des commandes</a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="text-center p-3">
            © 2024 Votre Boutique. Tous droits réservés.
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
    <?php
    exit;
}

// Récupérer les produits associés à la commande
$query_items = $conn->prepare("SELECT p.name, op.quantity, op.price 
                               FROM order_products op 
                               JOIN products p ON op.product_id = p.id 
                               WHERE op.order_id = ?");
$query_items->bind_param('i', $id);
$query_items->execute();
$items = $query_items->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la commande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f7fa;
        }
        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 30px;
        }
        .dashboard-content {
            padding: 40px;
            margin-left: 250px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #343a40;
            color: white;
            position: fixed;
            width: calc(100% - 00px);
            bottom: 0;
        }
    </style>
</head>
<body>

<div class="dashboard-content">
    <div class="container">
        <div class="card">
            <h2 class="mb-4">Détails de la commande #<?php echo $id; ?></h2>

            <p><strong>ID de l'utilisateur :</strong> <?php echo $order['user_id']; ?></p>
            <p><strong>Total :</strong> <?php echo $order['total']; ?> €</p>
            <p><strong>Status :</strong> <?php echo $order['status']; ?></p>
            <p><strong>Date de commande :</strong> <?php echo $order['created_at']; ?></p>

            <h3 class="mt-4">Produits commandés :</h3>
            <ul class="list-group mb-3">
                <?php while ($item = $items->fetch_assoc()): ?>
                    <li class="list-group-item">
                        <strong><?php echo $item['name']; ?></strong><br>
                        Quantité : <?php echo $item['quantity']; ?><br>
                        Prix unitaire : <?php echo $item['price']; ?> €
                    </li>
                <?php endwhile; ?>
            </ul>

            <a href="manage_orders.php" class="btn btn-secondary">Retour à la gestion des commandes</a>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="text-center p-3">
        © 2024 Votre Boutique. Tous droits réservés.
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
include '../includes/footer.php';
?>
