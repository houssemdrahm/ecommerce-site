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
    <a class="navbar-brand" href="index.php">Votre Boutique</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="https://localhost:8443/ecommerce-site/index.php">Accueil</a>
            </li>
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'products.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="https://localhost:8443/ecommerce-site/product.php">Produits</a>
            </li>
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="https://localhost:8443/ecommerce-site/contact.php">Contact</a>
            </li>
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'login.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="https://localhost:8443/ecommerce-site/auth/login.php">Connexion</a>
            </li>
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'register.php' ? 'active' : ''; ?>">
                <a class="nav-link" href="https://localhost:8443/ecommerce-site/auth/register.php">Inscription</a>
            </li>
        </ul>
    </div>
</nav>







<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h1 class="text-center">Contactez-nous</h1>

    <?php
    // Initialiser des variables pour le traitement du formulaire
    $name = $email = $message = '';
    $error = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars(trim($_POST['name']));
        $email = htmlspecialchars(trim($_POST['email']));
        $message = htmlspecialchars(trim($_POST['message']));

        // Validation simple
        if (empty($name) || empty($email) || empty($message)) {
            $error = "Tous les champs sont obligatoires.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Adresse e-mail invalide.";
        } else {
            // Ici, vous pouvez envoyer l'e-mail ou enregistrer les données dans la base de données
            // mail($to, $subject, $message, $headers);
            $success = "Votre message a été envoyé avec succès !";
            // Réinitialiser les champs
            $name = $email = $message = '';
        }
    }
    ?>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php elseif (isset($success)): ?>
        <div class="alert alert-success"><?php echo $success; ?></div>
    <?php endif; ?>

    <form action="contact.php" method="POST" class="mt-4">
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email :</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
        </div>
        <div class="form-group">
            <label for="message">Message :</label>
            <textarea class="form-control" id="message" name="message" required><?php echo $message; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
<br>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.11/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
