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

// Mise à jour du produit si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_name = $_POST['name'];
    $new_price = $_POST['price'];
    $new_description = $_POST['description'];
    $update_query = $conn->prepare("UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?");
    $update_query->bind_param('sdsi', $new_name, $new_price, $new_description, $id);

    if ($update_query->execute()) {
        $success_message = "Le produit a été mis à jour avec succès.";
        // Recharger les données du produit après la mise à jour
        $query = $conn->prepare("SELECT * FROM products WHERE id = ?");
        $query->bind_param('i', $id);
        $query->execute();
        $product = $query->get_result()->fetch_assoc();
    } else {
        $error_message = "Erreur lors de la mise à jour du produit.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .container {
            max-width: 900px;
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
        .form-label {
            font-weight: 500;
            color: #555;
        }
        .form-control {
            border-radius: 8px;
            box-shadow: none;
            border: 1px solid #ccc;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #0056b3;
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
        <h2>Modifier le produit #<?php echo htmlspecialchars($id); ?></h2>

        <!-- Message de succès ou d'erreur -->
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php elseif (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nom du produit</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Prix</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour le produit</button>
            <a href="manage_products.php" class="btn btn-secondary">Retour à la gestion des produits</a>
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
