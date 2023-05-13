<?php
    // Connexion à la base de données
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'resto';

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Vérification de la connexion
    if (!$conn) {
        die("La connexion a échoué : " . mysqli_connect_error());
    }

    // Récupération des données
    $starters = "SELECT name_meal, description, price  FROM meals WHERE type_meal='STARTER'";
    $resultat = mysqli_query($conn, $sql);
?>