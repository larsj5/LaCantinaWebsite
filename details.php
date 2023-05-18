<?php

//This brings in a twig instance for use by this script
require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/database.php';

//1. Get the meal ID parameter from the request
if(isset($_GET['a'])) 
{
    $db = new Db();
    $mealId = $db -> quote($_GET['a']); //make params safe for use in SQL queries
    $result = $db -> select("SELECT * FROM Meals WHERE meal_id =" . $mealId);

    if (count($result) > 0){
        // Meal loaded from store
        $meal = [
                'type'              => $result[0]['type_meal'],
                'image'             => $result[0]['img_path'],
                'name'              => $result[0]['name_meal'],
                'description'       => $result[0]['description']
                
        ];
        // Render view
        echo $twig->render('details.html', ['meal' => $meal]);
    }
    else
        echo $twig->render('404.html');
}
else
    echo $twig ->render('404.html');