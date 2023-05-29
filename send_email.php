<?php
require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/database.php';

session_start();

function clean_input($data) {
    $data = trim($data);
    //stripslashes(): The stripslashes() function removes backslashes.
    $data = stripslashes($data);
    //htmlspecialchars(): Convert special characters to HTML entities.
    $data = htmlspecialchars($data);
    return $data;
}

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
        array_push($favorites, ($db->select("SELECT name_meal FROM Meals WHERE meal_id = '$meal_ID'")));
    }

    for ($x = 0; $x < sizeof($favorites); $x++) {
        $favorites[$x] = $favorites[$x][0];
    }

    // loop through and add all names to the message
    for ($x = 0; $x < sizeof($favorites); $x++) {
        $message = $message . $favorites[$x]['name_meal'] . ", ";
    }
}

//The form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    //Check email field
    if (!empty($_POST["email"])) {
        $email = clean_input($_POST["email"]);
        //FILTER_VALIDATE_EMAIL is one of many validation filters: https://www.php.net/manual/en/filter.filters.validate.php
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $to = $email;
            $subject = "Your Favorite Dishes From La Cantina";
            // load the dish names into the message
            $result = mail($to,$subject,$message);
            if( $result == true ) {
                echo "Message sent successfully...";
             }else {
                echo "Message could not be sent...";
             }
        }
    }
}

header("Location: favorites.php");

?>


