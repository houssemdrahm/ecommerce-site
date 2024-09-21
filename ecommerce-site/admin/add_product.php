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

// Ajouter le produit si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $insert_query = $conn->prepare("INSERT INTO products (name, price, description) VALUES (?, ?, ?)");
    $insert_query->bind_param('sds', $name, $price, $description);

    if ($insert_query->execute()) {
        $success_message = "Le produit a été ajouté avec succès.";
    } else {
        $error_message = "Erreur lors de l'ajout du produit.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .sidebar {
            height: 100vh;
            background-color: #343a40;
            padding: 15px;
            color: white;
            position: fixed;
            width: 250px;
        }

        .sidebar h4 {
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 15px;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .sidebar ul li a:hover {
            background-color: #495057;
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
    <a class="navbar-brand" href="index.php">Votre Boutique</a>
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
<!-- Sidebar -->
<div class="sidebar">
    <h4>Admin Dashboard</h4>
    <ul>
        <li><a href="manage_products.php"><i class="fas fa-box"></i> Gérer les produits</a></li>
        <li><a href="manage_orders.php"><i class="fas fa-shopping-cart"></i> Gérer les commandes</a></li>
        <li><a href="manage_users.php"><i class="fas fa-users"></i> Gérer les utilisateurs</a></li>
    </ul>
</div>

<div class="container">
    <div class="card">
        <h2>Ajouter un nouveau produit</h2>

        <!-- Message de succès ou d'erreur -->
        <?php if (isset($success_message)): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
        <?php elseif (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Nom du produit</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Prix</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter le produit</button>
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
