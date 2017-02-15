<?php

namespace myProject\Framework;


class Router implements IRouter
{

    /*
     * @var string
     */
    private $controllerName = "DefaultController";

    /*
     * @var string
     */
    private $actionName = "indexAction";

    /*
     * @var array
     */
    private $actionParameters = [];

    /*
     * @var string
     */
    private $url;

    // CONSTRUCTEUR
    /**
     * Router constructor.
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $url;
        $this->matchRoute();
    }

    private function matchRoute()
    {
        $urlParts = explode('/', $this->url);
        // Suppression de la position du tableau
        // element de l'url (qui est toujours vide)
        array_shift($urlParts);

        if (count($urlParts) >= 1 && !empty($urlParts[0])) {
            // SI urlParts est supérieur à 1, c'est que j'ai un deuxième paramètre
            // ET si il n'est pas vide, ALORS

            // $urlParts[0] = empty($urlParts[0])?$controller:$urlParts[0]; Revient au même que dans la condition

            // Récupération du Controller
            $this->controllerName = ucfirst($urlParts[0]) . "Controller" ?? $this->controllerName;
            // Suppression du Controller
            array_shift($urlParts);

        }

        if (count($urlParts) >= 1 && !empty($urlParts[0])) { // SI urlParts est supérieur à 1, c'est que j'ai un deuxième paramètre
            // ET si il n'est pas vide, ALORS

            // $urlParts[0] = empty($urlParts[0])?$action:$urlParts[0]; Revient au même que dans la condition

            // Récupération de l'Action
            $this->actionName = $urlParts[1] ?? $this->actionName;
            // Suppression de l'Action
            array_shift($urlParts);

        }

        // Récupère les paramètres de la route sous forme de tableau, à passer à la méthode action
        if (count($urlParts) >= 1 && !empty($urlParts[0])) {

            $this->actionParameters = $urlParts;

        }
    }


    // GETTERS ET SETTERS
    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    /**
     * @param string $controllerName
     * @return Router
     */
    public function setControllerName(string $controllerName): Router
    {
        $this->controllerName = $controllerName;
        return $this;
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        return $this->actionName;
    }

    /**
     * @param string $actionName
     * @return Router
     */
    public function setActionName(string $actionName): Router
    {
        $this->actionName = $actionName;
        return $this;
    }

    /**
     * @return array
     */
    public function getActionParameters(): array
    {
        return $this->actionParameters;
    }

    /**
     * @param array $actionParameters
     * @return Router
     */
    public function setActionParameters(array $actionParameters): Router
    {
        $this->actionParameters = $actionParameters;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     * @return Router
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }


}