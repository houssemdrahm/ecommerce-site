<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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

        .card {
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .card .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        .card .card-icon {
            font-size: 3rem;
            color: #007bff;
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

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="/ecommerce-site/admin/admin_dashboard.php">Votre Boutique</a>
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

<div class="sidebar">
    <h4>Admin Dashboard</h4>
    <ul>
        <li><a href="manage_products.php"><i class="fas fa-box"></i> Gérer les produits</a></li>
        <li><a href="manage_orders.php"><i class="fas fa-shopping-cart"></i> Gérer les commandes</a></li>
        <li><a href="manage_users.php"><i class="fas fa-users"></i> Gérer les utilisateurs</a></li>
        <li><a href="edit_content.php"><i class="fas fa-edit"></i> Modifier le contenu</a></li>
        <li><a href="calculatrice.php"><i class="fas fa-edit"></i> calculatrice</a></li>
    </ul>
</div>

<div class="dashboard-content animate-dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm p-4 mb-4">
                    <div class="card-body text-center">
                        <div class="card-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <h5 class="card-title">Gérer les produits</h5>
                        <a href="manage_products.php" class="btn btn-primary mt-3">Voir les produits</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm p-4 mb-4">
                    <div class="card-body text-center">
                        <div class="card-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h5 class="card-title">Gérer les commandes</h5>
                        <a href="manage_orders.php" class="btn btn-primary mt-3">Voir les commandes</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm p-4 mb-4">
                    <div class="card-body text-center">
                        <div class="card-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h5 class="card-title">Gérer les utilisateurs</h5>
                        <a href="manage_users.php" class="btn btn-primary mt-3">Voir les utilisateurs</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm p-4 mb-4">
                    <div class="card-body text-center">
                        <div class="card-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <h5 class="card-title">Modifier le contenu</h5>
                        <a href="/ecommerce-site/edit_content.php" class="btn btn-primary mt-3">Modifier le contenu</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm p-4 mb-4">
                    <div class="card-body text-center">
                        <div class="card-icon">
                            <i class="fas fa-edit"></i>
                        </div>
                        <h5 class="card-title">calculatrice</h5>
                        <a href="/ecommerce-site/admin/calculatrice.php" class="btn btn-primary mt-3">calculer</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <p>&copy; 2024 Votre Boutique - Tous droits réservés</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
