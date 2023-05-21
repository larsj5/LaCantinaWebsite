<?php

//This brings in a twig instance for use by this script
require_once __DIR__.'/bootstrap.php';
require_once __DIR__.'/database.php';

//Load from the DB
$db = new Db();

$menu = $db -> select("SELECT * FROM MEALS");

echo $twig->render('menu.html', ['menu' => $menu]);

