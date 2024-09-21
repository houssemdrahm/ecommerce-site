
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Boutique en Ligne</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Votre Boutique</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="product.php">Produits</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://localhost:8443/ecommerce-site/auth/login.php">Connexion</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="https://localhost:8443/ecommerce-site/auth/register.php">Inscription</a>
            </li>
        </ul>
    </div>
</nav>

<div class="jumbotron text-center">
    <h1 class="display-4">Bienvenue sur notre boutique en ligne!</h1>
    <p class="lead">Découvrez nos derniers produits et promotions exclusives.</p>
    <a class="btn btn-primary btn-lg" href="https://localhost:8443/ecommerce-site/product.php" role="button">Voir les produits</a>
</div>

<div class="container">
    <h2 class="text-center my-4">Nos Produits Populaires</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="images/product1.jpg" class="card-img-top" alt="Produit 1">
                <div class="card-body">
                    <h5 class="card-title">Produit 1</h5>
                    <p class="card-text">Description courte du produit 1.</p>
                    <a href="#" class="btn btn-primary">Acheter</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="images/product2.jpg" class="card-img-top" alt="Produit 2">
                <div class="card-body">
                    <h5 class="card-title">Produit 2</h5>
                    <p class="card-text">Description courte du produit 2.</p>
                    <a href="#" class="btn btn-primary">Acheter</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="images/product3.jpg" class="card-img-top" alt="Produit 3">
                <div class="card-body">
                    <h5 class="card-title">Produit 3</h5>
                    <p class="card-text">Description courte du produit 3.</p>
                    <a href="https://localhost:8443/ecommerce-site/admin/checkout.php" class="btn btn-primary">Acheter</a>
                </div>
            </div>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
