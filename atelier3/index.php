<?php
// Démarre la session (Toujours en premier !)
session_start();

// --- EXERCICE 2 : COMPTEUR DE VISITES ---
// On vérifie si le compteur existe, sinon on l'initialise
if (!isset($_SESSION['visites'])) {
    $_SESSION['visites'] = 1;
} else {
    $_SESSION['visites']++;
}

// Redirection intelligente si déjà connecté
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // Si c'est un admin, on l'envoie chez les admins
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        header('Location: page_admin.php');
        exit();
    }
    // Si c'est un user, on l'envoie chez les users (Exercice 1)
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'user') {
        header('Location: page_user.php');
        exit();
    }
}

// Gérer le formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // --- EXERCICE 1 : Double vérification ---
    
    // CAS 1 : Admin
    if ($username === 'admin' && $password === 'secret') {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'admin'; // On retient son rôle
        header('Location: page_admin.php');
        exit();
    }
    // CAS 2 : User (Nouveau !)
    elseif ($username === 'user' && $password === 'utilisateur') {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'user'; // On retient son rôle
        header('Location: page_user.php');
        exit();
    } 
    else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Atelier 3</title>
</head>
<body>
    <h1>Atelier authentification par Session</h1>
    
    <div style="background-color: #f0f0f0; padding: 10px; border: 1px solid #ccc; margin-bottom: 20px;">
        <strong>Statistique :</strong> Vous avez visité cette page d'accueil <?php echo $_SESSION['visites']; ?> fois.
    </div>

    <h3>La page <a href="page_admin.php">page_admin.php</a> est réservée à 'admin'.</h3>
    <h3>La page <a href="page_user.php">page_user.php</a> est réservée à 'user'.</h3>

    <?php if (isset($error)) echo "<p style='color:red'>$error</p>"; ?>

    <form method="POST" action="">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required placeholder="admin ou user">
        <br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Se connecter</button>
    </form>
    <br>
    <a href="../index.html">Retour à l'accueil</a>  
</body>
</html>
