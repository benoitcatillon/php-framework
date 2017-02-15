<?php

namespace myProject\Forum\Controllers;


class DefaultController
{

    public function indexAction()
    {
        echo "Je suis l'index du Controller par Default";
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