<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "resto";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
  die("La connexion a échoué : " . mysqli_connect_error());
}
?>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Menu</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../assets/css/main.css">
        <link rel="shortcut icon" href="favicon1.png" type="image/x-icon">
        <link rel="preconnect" href="https://fonts.googleapis.com"> 
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
        <link href="https://fonts.googleapis.com/css2?family=Outfit&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Martel:wght@700&family=Outfit&display=swap" rel="stylesheet">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <header>
            <div class="title-box">
                <h1>La Cantina</h1>
                <p>L'Italie n'a jamais été si proche !</p>
            </div>

            <div class="slider">
                <div class="slides">
                    <div class="slide"><img src="../assets/images/header2.jpeg"></div>
                    <div class="slide"><img src="../assets/images/header1.jpeg"></div>
                    <div class="slide"><img src="../assets/images/header4.jpeg"></div>
                    <div class="slide"><img src="../assets/images/header3.jpeg"></div>
                </div>
            </div>

            <div class="page-title">
                <h1>Menu</h1>
            </div>
        </header>


        <div id="sticky-header" class="section-menu sticky">
            <nav class="menu">
                <ul>
                    <li class="nav-item starters"><a href="#starters">Starters</a></li>
                    <li class="nav-item mains"><a href="#mains">Mains</a></li>
                    <li class="nav-item desserts"><a href="#desserts">Desserts</a></li>
                    <li class="nav-item drinks"><a href="#drinks">Drinks</a></li>
                </ul>
            </nav>
        </div>

        <main id="main">

            <section id="starters" class="menu-bg">
                
                    <?php 
                    // Récupération des éléments de la table Meals
                    $sql = "SELECT * FROM Meals WHERE type_meal = 'STARTER'";
                    $result = mysqli_query($conn, $sql);

                    // Affichage des éléments de la table Meals
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='item'>";
                            echo "<div class='item-info'>";
                            echo "<div class='inside-item'>";
                            echo "<h2>" . $row['name_meal'] . "</h2>";
                            echo "<p class='item-info'>" . $row['description'] . "</p>";
                            echo "<p class='price'>" . $row['price'] . " €</p>";
                            echo "</div>";
                            echo "<img class='item' src='" . $row['img_path'] . "' alt='" . $row['name_meal'] . "'>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                    echo "0 résultats";
                    }
                    ?>

                

            </section>

            <section id="mains" class="menu-bg">

                
                <?php 
                    // Récupération des éléments de la table Meals
                    $sql = "SELECT * FROM Meals WHERE type_meal = 'MAIN'";
                    $result = mysqli_query($conn, $sql);

                    // Affichage des éléments de la table Meals
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='item'>";
                            echo "<div class='item-info'>";
                            echo "<div class='inside-item'>";
                            echo "<h2>" . $row['name_meal'] . "</h2>";
                            echo "<p class='item-info'>" . $row['description'] . "</p>";
                            echo "<p class='price'>" . $row['price'] . " €</p>";
                            echo "</div>";
                            echo "<img class='item' src='" . $row['img_path'] . "' alt='" . $row['name_meal'] . "'>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                    echo "0 résultats";
                    }
                    ?>

                

            </section>

            <section id="desserts" class="menu-bg">

                
                <?php 
                    // Récupération des éléments de la table Meals
                    $sql = "SELECT * FROM Meals WHERE type_meal = 'DESSERT'";
                    $result = mysqli_query($conn, $sql);

                    // Affichage des éléments de la table Meals
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='item'>";
                            echo "<div class='item-info'>";
                            echo "<div class='inside-item'>";
                            echo "<h2>" . $row['name_meal'] . "</h2>";
                            echo "<p class='item-info'>" . $row['description'] . "</p>";
                            echo "<p class='price'>" . $row['price'] . " €</p>";
                            echo "</div>";
                            echo "<img class='item' src='" . $row['img_path'] . "' alt='" . $row['name_meal'] . "'>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                    echo "0 résultats";
                    }
                    ?>
               

            </section>

            <section id="drinks" class="menu-bg">

                
                <?php 
                    // Récupération des éléments de la table Meals
                    $sql = "SELECT * FROM Meals WHERE type_meal = 'DRINK'";
                    $result = mysqli_query($conn, $sql);

                    // Affichage des éléments de la table Meals
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='item'>";
                            echo "<div class='item-info'>";
                            echo "<div class='inside-item'>";
                            echo "<h2>" . $row['name_meal'] . "</h2>";
                            echo "<p class='item-info'>" . $row['description'] . "</p>";
                            echo "<p class='price'>" . $row['price'] . " €</p>";
                            echo "</div>";
                            echo "<img class='item' src='" . $row['img_path'] . "' alt='" . $row['name_meal'] . "'>";
                            echo "</div>";
                            echo "</div>";
                        }
                    } else {
                    echo "0 résultats";
                    }
                    ?>
                

            </section>

        
            <script src="../assets/js/stickyscroll.js"></script>
    </body>
</html>