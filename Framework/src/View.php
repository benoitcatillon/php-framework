<?php

namespace myProject\Framework;


class View
{
    /**
     * @var string
     */
    private $layout;

    /**
     * View constructor.
     * @param string $layout
     */
    public function __construct($layout = 'layout')
    {

        $this->layout = $layout;

    }

    private function getRenderedView($template, array $data = [])
    {

        // Activation de la mise en tampon de la sortie - N'envoi rien dans la requête HTTP
        ob_start(); // output buffer

        // Mise à disposition des variables du tableau $data
        // pour la vue $template
        extract($data);

        // Inclusion de la vue
        require ROOT_PATH . "/src/views/{$template}.php";

        // Vide le tampon
        // Retour de l'interpolation de la Vue avec les données $data
        return ob_get_clean();

    }

    public function render($template, array $data = [])
    {

        // Contenu de la Vue
        $viewContent = $this->getRenderedView($template, $data);

        // Ajout du contenu de la Vue aux données
        $data['content'] = $viewContent;

        // Gestion du Titre | isset est possible
        if (array_key_exists('title', $data)) {
            $data['title'] = 'myProject Forum';
        }

        // Contenu du Layout avec le rendu de la Vue
        return $this->getRenderedView($this->layout, $data);

    }

}