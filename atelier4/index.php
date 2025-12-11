<?php
// --- FONCTION DE RECUPERATION UNIVERSELLE ---
function get_basic_auth_credentials() {
    // 1. Si PHP a déjà fait le travail (rare en FastCGI)
    if (isset($_SERVER['PHP_AUTH_USER'])) {
        return [$_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']];
    }

    // 2. On cherche le header "Authorization" caché
    $header = null;
    if (isset($_SERVER['HTTP_AUTHORIZATION'])) {
        $header = $_SERVER['HTTP_AUTHORIZATION'];
    } elseif (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) { // Souvent ici chez Alwaysdata
        $header = $_SERVER['REDIRECT_HTTP_AUTHORIZATION'];
    }

    // 3. Si on a trouvé le header, on le décrypte manuellement
    if ($header !== null && strpos(strtolower($header), 'basic') === 0) {
        // On enlève "Basic " et on décode
        list($user, $pw) = explode(':', base64_decode(substr($header, 6)));
        return [$user, $pw];
    }

    return [null, null];
}

// Récupération des identifiants via notre super fonction
list($user_input, $pass_input) = get_basic_auth_credentials();

// --- VERIFICATION ---
$login_valide = "admin";
$pass_valide = "header";

// Si pas d'user ou mauvais mot de passe
if ($user_input !== $login_valide || $pass_input !== $pass_valide) {
    // On envoie les headers pour afficher la fenêtre
    header('WWW-Authenticate: Basic realm="Zone Super Secrete"');
    header('HTTP/1.0 401 Unauthorized');
    
    // Message d'erreur
    echo 'Authentification requise. (Vos données reçues : User=' . ($user_input ?: 'Rien') . ')';
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head><title>Atelier 4 Réussi</title></head>
<body style="background-color: #dff0d8; color: #3c763d; padding: 50px; text-align: center;">
    <h1>🎉 VICTOIRE !</h1>
    <p>Vous êtes connecté en tant que : <strong><?php echo htmlspecialchars($user_input); ?></strong></p>
    <p>Le correctif FastCGI a fonctionné.</p>
</body>
</html>
