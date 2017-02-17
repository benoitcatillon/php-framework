<?php

namespace myProject\Forum\Controllers;

use myProject\Framework\View;


class DefaultController
{

    public function indexAction()
    {
        $view = new View();

        echo $view->render('homeView', ['name' => 'Benoît']);
    }

    public function notFoundAction()
    {
        echo "Ressource non trouvée";
    }

    public function showAction($id)
    {
        echo "J'affiche l'enregistrement dont l'id est $id";
    }

}