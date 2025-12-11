<?php
session_start();

// Protection : Si pas connecté OU si pas user -> Dehors !
if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'user') {
    header('Location: index.php');
    exit();
}
?>
<h1>Espace UTILISATEUR</h1>
<p>Bienvenue cher utilisateur standard.</p>
<a href="logout.php">Se déconnecter</a>
