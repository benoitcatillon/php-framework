<?php

namespace myProject\Framework;


class Dispatcher
{

    /**
     * @var IRouter
     * Instance de Router
     */
    private $router;

    /**
     * @var string
     */
    private $controllerNameSpace;

    /**
     * Dispatcher constructor.
     * @param Router $router
     * @param string $controllerNameSpace
     */
    public function __construct(IRouter $router, $controllerNameSpace)
    {
        $this->router = $router;
        $this->controllerNameSpace = $controllerNameSpace;
    }

    /**
     * Instanciation du Controller et l'appel de la méthode
     * en fonction des valeurs du routeur
     */
    public function dispatch()
    {

        $controllerName = $this->controllerNameSpace . $this->router->getControllerName();
        $actionName = $this->router->getActionName();
        $parameters = $this->router->getActionParameters();

        // Test de la NON EXISTENCE de la Class Controller
        if (!class_exists($controllerName)) {
            $controllerName = $this->controllerNameSpace . 'DefaultController';
            $actionName = "notFoundAction";
            $parameters = [];
        }

        $this->InvokeAction($controllerName, $actionName, $parameters);


    }

    /**
     * @param $controllerName
     * @param $actionName
     * @param $parameters
     */
    public function InvokeAction($controllerName, $actionName, $parameters)
    {
        // Test l'existance de la Class Controller
        if (class_exists($controllerName)) {

        }
        // Instanciation du Controller
        $controller = new $controllerName();

        // Invocation de la méthode Action
        // avec passage de paramètres
        call_user_func_array(
            [$controller, $actionName],
            $parameters
        );
    }


}