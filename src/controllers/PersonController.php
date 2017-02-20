<?php


namespace myProject\Forum\Controllers;

use myProject\Forum\Models\PersonneDAO;
use myProject\Framework\ServiceLocator;

class PersonController
{

    public function indexAction()
    {
        $dao = $this->getDAO();
        $list = $dao->findAll();

        header("Content-type: application/json");

        echo json_encode($list);

    }

    /**
     * @return PersonneDAO
     */
    private function getDAO()
    {
        return ServiceLocator::get('dao.personne');
    }

}