<?php
// This brings in a twig instance for use by this script
require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/database.php';

session_start();

// Vérifiez si l'utilisateur est connecté en vérifiant la présence de la variable de session
if (isset($_SESSION['username'])) {
    // Récupérez le nom d'utilisateur de la session
    $username = $_SESSION['username'];

    // Définissez une variable globale avec le message de bienvenue
    $twig->addGlobal('welcome_message', 'Welcome, ' . $username . ' !');
} else {
    // Définissez une variable globale avec le lien de connexion
    $twig->addGlobal('login_link', 'Please <a href="login.php">login</a> to use add favorite dishes.');
}

// Load from the DB
$db = new Db();
$menu = $db->select("SELECT * FROM MEALS");

echo $twig->render('menu.html', ['menu' => $menu]);
?>


