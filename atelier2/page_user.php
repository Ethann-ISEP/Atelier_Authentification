<?php
// Vérification de sécurité
// Si le cookie "authToken" N'EXISTE PAS, on vire la personne
if (!isset($_COOKIE['authToken'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Espace Membre</title>
</head>
<body>
    <h1 style="color:green">Accès Autorisé !</h1>
    
    <p>Bienvenue dans la zone sécurisée par Cookie.</p>
    
    <p>Votre jeton de session unique est : <strong><?php echo $_COOKIE['authToken']; ?></strong></p>
    
    <hr>
    
    <p><strong>Test :</strong> Ce cookie expire dans 1 minute.</p>
    <p>Si vous actualisez cette page dans 60 secondes, vous serez redirigé vers l'accueil.</p>
    
    <button onclick="window.location.reload();">Actualiser la page</button>
</body>
</html>
