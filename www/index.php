<?php

// Utilisation du namespace de la Class Utils
use myProject\Framework\Utils as MyUtils;

//Lancement de la session
session_start();

//Définition du chemin racine de l'application
define('ROOT_PATH', dirname(__DIR__));

// Définition de l'auto-chargement des classes
include ROOT_PATH . '/vendor/autoload.php';

// Inclusions des routes
//$routes = require ROOT_PATH . '/config/routes.php';


//Récupération de l'url
$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL) ?? "/";

var_dump($url);

/************** Routage de l'application ******************/

// Explode pour découper l'url

$urlParts = explode('/', $url);

// Suppression de la position du tableau
// element de l'url (qui est toujours vide)
array_shift($urlParts);

echo '<pre>';
var_dump($urlParts);
echo '</pre>';

// Valeur par Défaut
$controller = "DefautController";
$action = "indexAction";
$params = [];

if (count($urlParts) >= 1 && !empty($urlParts[0])) { // SI urlParts est supérieur à 1, c'est que j'ai un deuxième paramètre
    // ET si il n'est pas vide, ALORS

    // $urlParts[0] = empty($urlParts[0])?$controller:$urlParts[0]; Revient au même que dans la condition

    // Récupération du Controller
    // $urlParts[1] peut s'évaluer à FALSE, alors j'instancie la valeur par défaut
    $controller = ucfirst($urlParts[0]) . "Controller" ?? $controller;
    // Suppression du Controller
    array_shift($urlParts);

}

if (count($urlParts) >= 1 && !empty($urlParts[0])) { // SI urlParts est supérieur à 1, c'est que j'ai un deuxième paramètre
    // ET si il n'est pas vide, ALORS

    // $urlParts[0] = empty($urlParts[0])?$action:$urlParts[0]; Revient au même que dans la condition

    // Récupération de l'Action
    // $urlParts[1] peut s'évaluer à FALSE, alors j'instancie la valeur par défaut
    $action = $urlParts[1] ?? $action;
    // Suppression de l'Action
    array_shift($urlParts);

}

if (count($urlParts) >= 1 && !empty($urlParts[0])) {

    $params = $urlParts;

}


$result = MyUtils::camelized('ajout-du-client');

echo '<pre>';
var_dump($result);
echo '</pre>';

echo '<pre>';
var_dump($controller);
echo '</pre>';

echo '<pre>';
var_dump($action);
echo '</pre>';

echo '<pre>';
var_dump($params);
echo '</pre>';

?>