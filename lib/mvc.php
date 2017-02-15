<?php

/**
 * Récupération de l'interprétation d'un template
 * @param string $templateName
 * @param array $vars
 * @return string
 */
function getTemplate(string $templateName, array $vars): string
{
    $path = ROOT_PATH . '/views/' . $templateName . '.php';

    if (file_exists($path)) {
        //Conversion des clefs d'un tableau associatif en variables
        extract($vars);
        ob_start();
        require $path;

        $content = ob_get_clean();
    } else {
        $content = "Impossible de charger le modèle";
    }

    return $content;
}

/**
 * Affichage d'un vue décorée par un layout
 * @param string $viewName
 * @param array $vars
 * @param string $layout
 */
function renderView(
    string $viewName,
    array $vars = [],
    string $layout = 'layout')
{
    //Récupération du rendu de la vue
    $vars['content'] = getTemplate($viewName, $vars);

    //Récupération du rendu du gabarit
    $response = getTemplate($layout, $vars);

    //Affichage de la réponse
    echo $response;
}