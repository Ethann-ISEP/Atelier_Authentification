<?php
// On démarre le script PHP
if (isset($_POST['login']) && isset($_POST['password'])) {

    // EXERCICE 3 : Vérification des identifiants (user / utilisateur)
    if ($_POST['login'] === "user" && $_POST['password'] === "utilisateur") {

        // EXERCICE 2 : Générer un jeton unique et aléatoire
        $token = bin2hex(random_bytes(16)); 

        // EXERCICE 1 : Créer le cookie 'authToken' qui expire dans 60 secondes
        // Syntaxe : setcookie(Nom, Valeur, DateExpiration, Chemin)
        setcookie("authToken", $token, time() + 60, "/");

        // Redirection vers la page sécurisée
        header("Location: page_user.php");
        exit();
    } else {
        $message = "Mauvais login ou mot de passe !";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Atelier 2 - Connexion</title>
</head>
<body>
    <h2>Formulaire de connexion (Cookie)</h2>
    <?php if(isset($message)) echo "<p style='color:red'>$message</p>"; ?>

    <form method="POST" action="">
        <label>Login : </label>
        <input type="text" name="login" required placeholder="user"><br><br>

        <label>Mot de passe : </label>
        <input type="password" name="password" required placeholder="utilisateur"><br><br>

        <button type="submit">Se connecter</button>
    </form>
</body>
</html>
