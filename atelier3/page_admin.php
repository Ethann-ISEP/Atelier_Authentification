<?php
// Démarrer la session
session_start();

// SÉCURITÉ : Vérifier si connecté ET si c'est bien un ADMIN
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['role'] !== 'admin') {
    header('Location: index.php'); // Hop, retour à l'accueil si ce n'est pas le chef
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Admin Protégée</title>
</head>
<body style="background-color: #ffcccc;"> <h1>Bienvenue sur la page ADMINISTRATEUR</h1>
    <p>Vous êtes connecté en tant que : <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></p>
    <p><em>Cette page est inaccessible aux utilisateurs classiques.</em></p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
