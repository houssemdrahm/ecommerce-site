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

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user'; 

    // Vérifier si le nom d'utilisateur existe déjà
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    if (!$stmt) {
        die("Erreur de préparation : " . $conn->error);
    }
    
    $stmt->bind_param('s', $username);
    $stmt->execute();    
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "Le nom d'utilisateur existe déjà.";
    } else {
        // Insertion dans la base de données
        $stmt->close(); // Fermez l'ancienne instruction

        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("Erreur de préparation : " . $conn->error);
        }

        $stmt->bind_param('sss', $username, $password, $role);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Inscription réussie !</div>";
        } else {
            echo "Erreur lors de l'inscription : " . $stmt->error;
        }
    }

    $stmt->close(); // Fermez l'instruction après utilisation
    $result->free(); // Libérez le résultat
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="https://localhost:8443/ecommerce-site/index.php">Votre Boutique</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="https://localhost:8443/ecommerce-site/index.php">Accueil</a>
            </li>
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'product.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="https://localhost:8443/ecommerce-site/product.php">Produits</a>
            </li>
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="https://localhost:8443/ecommerce-site/contact.php">Contact</a>
            </li>
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="login.php">Connexion</a>
            </li>
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'register.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="register.php">Inscription</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Inscription</h2>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger text-center"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="register.php" method="POST">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur :</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe :</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">S'inscrire</button>
            </form>

            <p class="text-center mt-3">Déjà inscrit ? <a href="login.php">Se connecter</a></p>
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
