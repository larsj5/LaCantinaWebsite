<?php 
// This brings in a twig instance for use by this script
require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/database.php';

session_start();

// Vérifiez si l'utilisateur est connecté en vérifiant la présence de la variable de session
if (isset($_SESSION['username'])) {
    // Récupérez le nom d'utilisateur de la session
    $username = $_SESSION['username'];

    // Load from the DB
    $db = new Db();
    $user = $db->select("SELECT id FROM users WHERE username = '" . trim($username) . "'");
    $userId = $user[0]['id'];

    $favorites = array();
    
    $favorite_IDs = $db->select("SELECT meal_ID FROM meal_fav WHERE user_ID = '$userId'");
    
    foreach($favorite_IDs as $ID) {
        $meal_ID = $ID['meal_ID'];
        array_push($favorites, ($db->select("SELECT * FROM Meals WHERE meal_id = '$meal_ID'")));
    }

    for ($x = 0; $x < sizeof($favorites); $x++) {
        $favorites[$x] = $favorites[$x][0];
    }

    // Définissez une variable globale avec le message de bienvenue
    $twig->addGlobal('welcome_message', 'Welcome, ' . $username . ' !');
} else {
    // Définissez une variable globale avec le lien de connexion
    $twig->addGlobal('login_link', 'Please <a href="login.php">login</a> to use add favorite dishes.');
}

echo $twig->render('favorites.html', ['favorites' => $favorites]);

?>