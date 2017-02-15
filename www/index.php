<?php
//Lancement de la session
session_start();

//Définition du chemin racine de l'application
define('ROOT_PATH', dirname(__DIR__));

//inclusions des routes
$routes = require ROOT_PATH . '/config/routes.php';

//Inclusion de la bibliothèque mvc
require ROOT_PATH . '/lib/mvc.php';

//Récupération de l'url
$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL) ?? "/";

/************** Routage de l'application ******************/

//Faire la correspondance entre un url et un contrôleur
if (array_key_exists($url, $routes)) {
    $controller = $routes[$url];
} else {
    $controller = "notFoundController.php";
}

//Tester l'existence du contrôleur
if (!file_exists(ROOT_PATH . '/controllers/' . $controller)) {
    $controller = "notFoundController.php";
}

//Exécution du contrôleur
require ROOT_PATH . '/controllers/' . $controller;

?>