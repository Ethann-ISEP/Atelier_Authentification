<?php
// Définition des bons identifiants
$login_valide = "admin";
$pass_valide = "header";

// On vérifie si les variables PHP_AUTH_USER et PHP_AUTH_PW sont remplies
// (Ces variables sont remplies automatiquement par PHP quand le navigateur envoie le header "Authorization")
if (!isset($_SERVER['PHP_AUTH_USER']) || 
    $_SERVER['PHP_AUTH_USER'] !== $login_valide || 
    $_SERVER['PHP_AUTH_PW'] !== $pass_valide) {

    // --- C'est ici que la magie des HEADERS opère ---
    
    // 1. On dit au navigateur : "Authentification requise" (Basic)
    // Le "realm" est le petit message qui s'affiche parfois dans la fenêtre
    header('WWW-Authenticate: Basic realm="Zone Secrete Atelier 4"');
    
    // 2. On envoie le code d'erreur HTTP 401 (Non autorisé)
    header('HTTP/1.0 401 Unauthorized');
    
    // 3. On affiche un message pour ceux qui cliquent sur "Annuler"
    echo 'Vous avez annulé l\'authentification. Accès refusé.';
    
    // 4. On arrête le script ici pour ne pas afficher le contenu protégé
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Atelier 4 - HTTP Headers</title>
</head>
<body style="background-color: #e0f7fa; font-family: sans-serif;">
    <div style="border: 2px solid #006064; padding: 20px; border-radius: 10px; max-width: 600px; margin: 50px auto;">
        <h1 style="color: #006064;">Succès !</h1>
        <p>Si vous voyez ceci, c'est que votre navigateur a envoyé le bon Header <strong>Authorization</strong>.</p>
        <hr>
        <p><strong>Vos informations (décodées par le serveur) :</strong></p>
        <ul>
            <li>User : <?php echo $_SERVER['PHP_AUTH_USER']; ?></li>
            <li>Password : <?php echo $_SERVER['PHP_AUTH_PW']; ?></li>
        </ul>
        <p><em>Contrairement à l'Atelier 1 (.htaccess), ici c'est PHP qui a décidé de vous laisser entrer.</em></p>
    </div>
</body>
</html>
