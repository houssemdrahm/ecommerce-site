<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}

// Connect to the database
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

// Fetch existing content
$contentQuery = $conn->query("SELECT * FROM site_content WHERE id = 1");
$content = $contentQuery->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update content
    $title = $_POST['title'];
    $description = $_POST['description'];

    // Prepare and bind
    $stmt = $conn->prepare("UPDATE site_content SET title=?, description=? WHERE id = 1");
    $stmt->bind_param("ss", $title, $description);

    if ($stmt->execute()) {
        header("Location: edit_content.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le contenu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background-color: #f5f7fa;
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

        .dashboard-content {
            margin-left: 250px;
            padding: 40px;
        }

        .table-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: #007bff;
            color: white;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
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

        .animate-dashboard {
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
<div class="sidebar">
    <h4>Admin Dashboard</h4>
    <ul>
        <li><a href="manage_products.php"><i class="fas fa-box"></i> Gérer les produits</a></li>
        <li><a href="manage_orders.php"><i class="fas fa-shopping-cart"></i> Gérer les commandes</a></li>
        <li><a href="manage_users.php"><i class="fas fa-users"></i> Gérer les utilisateurs</a></li>
        <li><a href="edit_content.php"><i class="fas fa-edit"></i> Modifier le contenu</a></li>
    </ul>
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/ecommerce-site/admin/admin_dashboard.php">Votre Boutique</a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="https://localhost:8443/ecommerce-site/index.php">Déconnexion</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5" style="margin-left: 270px;"> <!-- Adding margin to align with the sidebar -->
    <h2>Modifier le contenu de la boutique</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" id="title" name="title" class="form-control" value="<?php echo htmlspecialchars($content['title']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" required><?php echo htmlspecialchars($content['description']); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>

<!-- Footer -->
<footer class="footer">
    <p>&copy; 2024 Votre Boutique - Tous droits réservés</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
