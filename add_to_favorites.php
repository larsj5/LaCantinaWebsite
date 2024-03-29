<?php
require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/database.php';

session_start();

// Vérifiez si l'utilisateur est connecté
if (isset($_SESSION['username'])) {
    // Récupérez le nom d'utilisateur de la session
    $username = $_SESSION['username'];

    // Vérifiez si l'ID du plat a été envoyé depuis le formulaire
    if (isset($_POST['mealId'])) {
        // Récupérez l'ID du plat
        $mealId = $_POST['mealId'];

        // Connexion à la base de données
        $db = new Db();

        // Vérifiez si l'utilisateur existe dans la base de données
        $user = $db->select("SELECT id FROM users WHERE username = '" . trim($username) . "'");
        echo $username;
        print_r($user);

        if ($user) {
            // L'utilisateur existe, ajoutez l'ID du plat à ses favoris
            $userId = $user[0]['id'];

            // Make sure that it doesn't already exist
            if (!($db->select("SELECT * FROM meal_fav WHERE user_id ='$userId' AND meal_id ='$mealId'"))) {
                $db->query("INSERT INTO meal_fav(user_id,meal_id) VALUES ('$userId','$mealId')");
            }
            header("Location: menu.php");
    
        } else {
            
        }
    }
}
?>
