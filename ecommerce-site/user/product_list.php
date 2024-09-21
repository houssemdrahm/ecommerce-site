<?php
session_start();

// Database connection parameters
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "ecommerce_db"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Fetch products from the database
$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$result = $stmt->get_result();
$products = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f7fa;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }
        .footer {
            background-color: #007bff;
            color: white;
        }
        .product-price {
            font-size: 1.2rem;
            font-weight: bold;
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
            <li class="nav-item active">
                <a class="nav-link" href="product_list.php">Produits</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="cart.php">Votre Panier</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Déconnexion</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2 class="text-center mb-4">Liste des Produits</h2>
    <div class="row">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <p class="product-price"><?php echo htmlspecialchars($product['price']); ?> €</p>
                        <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                        <a href="add_to_cart.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Ajouter au panier</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
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
                    <li><a href="product_list.php" class="text-dark">Produits</a></li>
                    <li><a href="contact.php" class="text-dark">Contact</a></li>
                    <li><a href="login.php" class="text-dark">Connexion</a></li>
                    <li><a href="register.php" class="text-dark">Inscription</a></li>
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
