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

//The form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    //Check email field
    if (!empty($_POST["email"])) {
        $email = clean_input($_POST["email"]);
        //FILTER_VALIDATE_EMAIL is one of many validation filters: https://www.php.net/manual/en/filter.filters.validate.php
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $from = "lacantina@gmail.com";
            $to = $email;
            $subject = "Your Favorite Dishes From La Cantina";
            $message = "Dish titles";
            $headers = "From: " . $from;
            mail($to,$subject,$message, $headers);
        }
    }
}

header("Location: favorites.php");

?>


