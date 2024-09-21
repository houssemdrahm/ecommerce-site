<?php
session_start();
include '../includes/header.php';
include '../includes/db.php';

// Initialiser des variables
$email = $new_password = $confirm_password = '';
$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));
    $new_password = htmlspecialchars(trim($_POST['new_password']));
    $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));

    // Validation simple
    if (empty($email) || empty($new_password) || empty($confirm_password)) {
        $error = "Tous les champs sont obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Adresse e-mail invalide.";
    } elseif ($new_password !== $confirm_password) {
        $error = "Les mots de passe ne correspondent pas.";
    } else {
        // Vérifier si l'email existe dans la base de données
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Mettre à jour le mot de passe
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $update_stmt->bind_param('ss', $hashed_password, $email);
            $update_stmt->execute();

            $success = "Votre mot de passe a été réinitialisé avec succès.";
        } else {
            $error = "Aucun compte trouvé avec cette adresse e-mail.";
        }
    }
}
?>

<h1>Réinitialiser le mot de passe</h1>

<?php if (!empty($error)): ?>
    <div class="error"><?php echo $error; ?></div>
<?php elseif (!empty($success)): ?>
    <div class="success"><?php echo $success; ?></div>
<?php endif; ?>

<form action="reset_password.php" method="POST">
    <label for="email">Email :</label><br>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>

    <label for="new_password">Nouveau mot de passe :</label><br>
    <input type="password" id="new_password" name="new_password" required><br><br>

    <label for="confirm_password">Confirmer le nouveau mot de passe :</label><br>
    <input type="password" id="confirm_password" name="confirm_password" required><br><br>

    <button type="submit">Réinitialiser le mot de passe</button>
</form>

<?php include '../includes/footer.php'; ?>
