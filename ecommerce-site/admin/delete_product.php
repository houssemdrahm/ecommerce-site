<?php
session_start();

// Vérification du rôle de l'utilisateur (administrateur)
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "ecommerce_db"; 

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Vérification de l'ID du produit
$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id === null) {
    echo "<h1>ID de produit non spécifié.</h1>";
    exit;
}

// Récupérer les détails du produit
$query = $conn->prepare("SELECT * FROM products WHERE id = ?");
$query->bind_param('i', $id);
$query->execute();
$product = $query->get_result()->fetch_assoc();

// Vérification si le produit existe
if (!$product) {
    echo "<h1>Produit non trouvé.</h1>";
    exit;
}

// Supprimer le produit si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $delete_query = $conn->prepare("DELETE FROM products WHERE id = ?");
    $delete_query->bind_param('i', $id);

    if ($delete_query->execute()) {
        $success_message = "Le produit a été supprimé avec succès.";
    } else {
        $error_message = "Erreur lors de la suppression du produit.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer le produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .container {
            max-width: 600px;
            margin-top: 40px;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            background-color: white;
            padding: 30px;
            margin-bottom: 20px;
        }
        .card h2 {
            font-weight: 600;
            color: #333;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .btn-secondary {
            border-radius: 8px;
            padding: 10px 20px;
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

<div class="container">
    <div class="card">
        <h2>Supprimer le produit #<?php echo htmlspecialchars($id); ?></h2>

        <!-- Message de succès ou d'erreur -->
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
            <a href="manage_products.php" class="btn btn-secondary">Retour à la gestion des produits</a>
        <?php elseif (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
            <a href="manage_products.php" class="btn btn-secondary">Retour à la gestion des produits</a>
        <?php else: ?>
            <p>Êtes-vous sûr de vouloir supprimer le produit <strong><?php echo htmlspecialchars($product['name']); ?></strong> ?</p>
            <form method="POST">
                <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                <a href="manage_products.php" class="btn btn-secondary">Annuler</a>
            </form>
        <?php endif; ?>
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
