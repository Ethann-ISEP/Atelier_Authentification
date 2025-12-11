<?php
// --- CORRECTIF SPECIAL FASTCGI/ALWAYS.DATA ---
// Si les variables sont vides mais que le header Authorization existe, on les remplit nous-mêmes
if (empty($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['HTTP_AUTHORIZATION'])) {
    list($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
}
// ----------------------------------------------

// Définition des bons identifiants
$login_valide = "admin";
$pass_valide = "header";

// On vérifie si les variables sont remplies et correctes
if (!isset($_SERVER['PHP_AUTH_USER']) || 
    $_SERVER['PHP_AUTH_USER'] !== $login_valide || 
    $_SERVER['PHP_AUTH_PW'] !== $pass_valide) {

    // 1. On demande l'authentification
    header('WWW-Authenticate: Basic realm="Zone Secrete Atelier 4"');
    header('HTTP/1.0 401 Unauthorized');
    
    // 2. Message pour le bouton Annuler
    echo 'Vous avez annulé l\'authentification. Accès refusé.';
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Atelier 4 - HTTP Headers (Corrigé)</title>
</head>
<body style="background-color: #e0f7fa; font-family: sans-serif;">
    <div style="border: 2px solid #006064; padding: 20px; border-radius: 10px; max-width: 600px; margin: 50px auto;">
        <h1 style="color: #006064;">Succès !</h1>
        <p>Le correctif FastCGI a fonctionné. PHP a bien reçu vos identifiants.</p>
        <hr>
        <ul>
            <li>User : <strong><?php echo htmlspecialchars($_SERVER['PHP_AUTH_USER']); ?></strong></li>
            <li>Password : <strong><?php echo htmlspecialchars($_SERVER['PHP_AUTH_PW']); ?></strong></li>
        </ul>
    </div>
</body>
</html>
