<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les Produits</title>
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
            /* Ajout de marge en bas pour éviter que le footer ne recouvre le contenu */
            margin-bottom: 100px;
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

        .animate-dashboard {
            animation: fadeInUp 1s ease;
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
<!-- Sidebar -->
<div class="sidebar">
    <h4>Admin Dashboard</h4>
    <ul>
        <li><a href="manage_products.php"><i class="fas fa-box"></i> Gérer les produits</a></li>
        <li><a href="manage_orders.php"><i class="fas fa-shopping-cart"></i> Gérer les commandes</a></li>
        <li><a href="manage_users.php"><i class="fas fa-users"></i> Gérer les utilisateurs</a></li>
        <li><a href="edit_content.php"><i class="fas fa-edit"></i> Modifier le contenu</a></li>
    </ul>
</div>

<!-- Page Content -->
<div class="dashboard-content animate-dashboard">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Liste des Produits</h2>
            <a href="add_product.php" class="btn btn-primary">Ajouter un Produit</a>
        </div>

        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Prix</th>
                        <th>Catégorie</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Bouclez sur les produits ici -->
                    <tr>
                        <td>1</td>
                        <td>Produit A</td>
                        <td>€50.00</td>
                        <td>Catégorie 1</td>
                        <td>20</td>
                        <td>
                            <a href="edit_product.php?id=1" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="delete_product.php?id=1" class="btn btn-danger btn-sm">Supprimer</a>
                        </td>
                    </tr>
                    <!-- Autres produits -->
                </tbody>
            </table>
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