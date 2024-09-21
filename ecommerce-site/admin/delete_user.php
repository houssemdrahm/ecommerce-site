<?php
session_start();

// Check if the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

// Check if the user ID to delete is provided
if (!isset($_GET['id'])) {
    header("Location: manage_users.php");
    exit;
}

// Include the database connection

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


$userId = $_GET['id'];

// Fetch user details (optional, for showing confirmation)
$query = $conn->prepare("SELECT * FROM users WHERE id = ?");
$query->bind_param("i", $userId);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    // If user not found, redirect to manage users page
    header("Location: manage_users.php");
    exit;
}

// If the deletion is confirmed via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Delete the user from the database
    $deleteQuery = $conn->prepare("DELETE FROM users WHERE id = ?");
    $deleteQuery->bind_param("i", $userId);

    if ($deleteQuery->execute()) {
        // User deleted, redirect to the manage users page
        header("Location: manage_users.php?status=deleted");
        exit;
    } else {
        $error = "Une erreur est survenue lors de la suppression de l'utilisateur.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer l'utilisateur</title>
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
            margin-top: 50px;
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
    <div class="container">
        <div class="card">
            <h2 class="mb-4">Supprimer l'utilisateur</h2>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <p>Êtes-vous sûr de vouloir supprimer l'utilisateur <strong><?php echo $user['name']; ?></strong> (ID: <?php echo $user['id']; ?>) ? Cette action est irréversible.</p>
            
            <form action="delete_user.php?id=<?php echo $userId; ?>" method="POST">
                <a href="manage_users.php" class="btn btn-secondary">Annuler</a>
                <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
            </form>
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
