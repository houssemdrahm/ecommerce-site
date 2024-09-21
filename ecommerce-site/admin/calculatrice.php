<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Kufi+Arabic&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f7fa; 
            margin: 0;
            padding: 0;
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
            padding: 30px; 
            padding-bottom: 70px; 
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #343a40;
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
            left: 0;
            z-index: 1000;
        }

        .image-container {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 180px;
            border-radius: 8px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }

        /* CSS pour la calculatrice */
        .table-bordered {
            background-color: #ffffff; 
            border-radius: 8px; 
            overflow: hidden; 
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); 
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

    <div class="dashboard-content">
        <img class="image-container" src="../assets/css/images/IMG_20240112_092958_699.jpg" alt="salam">

        <div class="container mt-5">
            <h2 class="text-center">E-commerce Price Calculator</h2>

            <div class="text-center mb-3">
                <button class="btn btn-success" onclick="addRow()">Add New Cost Item</button>
            </div>

            <table class="table1 table table-bordered mt-4" id="costTable">
                <thead>
                    <tr>
                        <th>Cost Item</th>
                        <th>Price (in DZD)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Delivery Rate (%)</td>
                        <td><input type="number" class="form-control rate-input" id="deliveryRate" placeholder="Enter Delivery Rate" value="50" oninput="calculateTotal()"></td>
                        <td><button class="btn btn-secondary" disabled>Fixed</button></td>
                    </tr>
                    <tr>
                        <td>Confirmation Rate (%)</td>
                        <td><input type="number" class="form-control rate-input" id="confirmationRate" placeholder="Enter Confirmation Rate" value="50" oninput="calculateTotal()"></td>
                        <td><button class="btn btn-secondary" disabled>Fixed</button></td>
                    </tr>
                    <tr>
                        <td>Cost (DZD)</td>
                        <td><input type="number" class="form-control cost-input" id="cost" placeholder="Enter Cost" oninput="calculateTotal()"></td>
                        <td><button class="btn btn-secondary" disabled>Fixed</button></td>
                    </tr>
                    <tr>
                        <td><strong>Delivered Order Cost</strong></td>
                        <td><input type="number" id="deliveredOrderCost" class="form-control" readonly></td>
                        <td></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td><strong>Total Cost</strong></td>
                        <td><input type="number" id="totalCost" class="form-control" readonly></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>

            <div class="text-center mb-3">
                <button class="btn btn-primary" onclick="calculateTotal()">Calculate Total</button>
            </div>
        </div>
    </div>

    <script>
        function addRow() {
            const tableBody = document.querySelector('#costTable tbody');
            const newRow = document.createElement('tr');

            newRow.innerHTML = `
                <td><input type="text" class="form-control" placeholder="Enter Cost Item"></td>
                <td><input type="number" class="form-control cost-input" placeholder="Enter Price" oninput="calculateTotal()"></td>
                <td><button class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
            `;

            tableBody.appendChild(newRow);
        }

        function removeRow(button) {
            const row = button.parentElement.parentElement;
            row.remove();
            calculateTotal();
        }

        function calculateDeliveredOrderCost() {
            const confirmationRate = parseFloat(document.getElementById('confirmationRate').value) / 100 || 0;
            const deliveryRate = parseFloat(document.getElementById('deliveryRate').value) / 100 || 0;
            const cost = parseFloat(document.getElementById('cost').value) || 0;

            let deliveredOrderCost = 0;
            if (confirmationRate > 0 && deliveryRate > 0) {
                deliveredOrderCost = cost / (confirmationRate * deliveryRate);
            }

            document.getElementById('deliveredOrderCost').value = deliveredOrderCost.toFixed(2);
        }

        function calculateTotal() {
            calculateDeliveredOrderCost();

            const deliveredOrderCost = parseFloat(document.getElementById('deliveredOrderCost').value) || 0;

            const costInputs = document.querySelectorAll('.cost-input');
            let additionalCosts = 0;

            costInputs.forEach(input => {
                additionalCosts += parseFloat(input.value) || 0;
            });

            const totalCost = deliveredOrderCost + additionalCosts;

            document.getElementById('totalCost').value = totalCost.toFixed(2);
        }
    </script>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 Votre Boutique - Tous droits réservés</p>
    </footer>
</body>
</html>
