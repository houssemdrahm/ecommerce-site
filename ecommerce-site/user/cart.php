<?php
session_start();

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Connexion à la base de données

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


// Récupération des informations du panier
$username = $_SESSION['username'];
$stmt = $conn->prepare("SELECT * FROM cart WHERE username = ?");
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$cartItems = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Panier</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f7fa;
        }
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .footer {
            background-color: #007bff;
            color: white;
        }
        .table {
            transition: background-color 0.3s;
        }
        .table-hover tbody tr:hover {
            background-color: #e9ecef;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="https://localhost:8443/ecommerce-site/index.php">Votre Boutique</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="user_dashboard.php">Tableau de bord</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="cart.php">Votre Panier</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Déconnexion</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center mb-4">Votre Panier</h2>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <?php if (empty($cartItems)): ?>
                <div class="alert alert-warning text-center">Votre panier est vide.</div>
            <?php else: ?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cartItems as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                                <td><?php echo htmlspecialchars($item['price']); ?> €</td>
                                <td>
                                    <a href="remove_from_cart.php?id=<?php echo $item['id']; ?>" class="btn btn-danger btn-sm">Retirer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="text-right">
                    <a href="checkout.php" class="btn btn-success">Procéder au paiement</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>


<footer class="bg-light text-center text-lg-start">
    <div class="container p-4">
        <div class="row">
            <div class="col-lg-4 col-md-12 mb-4">
                <h5 class="text-uppercase">À propos de nous</h5>
                <p>
                    Votre Boutique est dédiée à offrir les meilleurs produits à nos clients.
                    Notre objectif est de vous fournir une expérience d'achat inoubliable.
                </p>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="text-uppercase">Liens utiles</h5>
                <ul class="list-unstyled">
                    <li>
                        <a href="https://localhost:8443/ecommerce-site/product.php" class="text-dark">Produit</a>
                    </li>
                    <li>
                        <a href="/contact.php" class="text-dark">Contact</a>
                    </li>
                    <li>
                        <a href="/login.php" class="text-dark">Connexion</a>
                    </li>
                    <li>
                        <a href="/register.php" class="text-dark">Inscription</a>
                    </li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="text-uppercase">Contact</h5>
                <p>
                    Email : contact@example.com<br>
                    Téléphone : +33 1 23 45 67 89<br>
                    Adresse : 123 Rue Exemple, 75000 Paris, France
                </p>
            </div>
        </div>
    </div>

    <div class="text-center p-3" style="background-color: #f8f9fa;">
        © 2024 Votre Boutique. Tous droits réservés.
    </div>
</footer>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
