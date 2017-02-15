<?php

// Utilisation des namespaces
use myProject\Framework\Router;
use myProject\Framework\Dispatcher;

//Lancement de la session
session_start();

//Définition du chemin racine de l'application
define('ROOT_PATH', dirname(__DIR__));

// Définition de l'auto-chargement des classes
include ROOT_PATH . '/vendor/autoload.php';

// Inclusions des routes
// $routes = require ROOT_PATH . '/config/routes.php';

// TEST
// $result = MyUtils::camelized('ajout-du-client');


//Récupération de l'url
$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL) ?? "/";

// var_dump($url);


/************** Routage de l'application ******************/

$router = new Router($url);

$dispatcher = new Dispatcher($router, "myProject\\Forum\\Controllers\\");
$dispatcher->dispatch();

/*
echo '<pre>';
var_dump($router);
echo '</pre>';
*/

?>