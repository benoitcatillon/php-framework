<?php

include 'vendor/autoload.php';

use myProject\Framework\Router;

class RouterTest extends PHPUnit_Framework_TestCase
{

    public function testRouterDefaultValue()
    {
        $router = new Router('/');

        $this->assertEquals(
            'DefaultController',
            $router->getControllerName(),
            "La valeur par défaut n'est pas DefaultController"
        );

        $this->assertEquals(
            'indexAction',
            $router->getActionName(),
            "La valeur par défaut n'est pas indexAction"
        );

        $this->assertEquals(
            [],
            $router->getActionParameters(),
            "La valeur par défaut n'est pas un tableau vide"
        );

    }

    public function testRouterWithNullUrl()
    {
        $router = new Router(null);

        $this->assertEquals(
            'DefaultController',
            $router->getControllerName(),
            "La valeur par défaut n'est pas DefaultController"
        );

        $this->assertEquals(
            'indexAction',
            $router->getActionName(),
            "La valeur par défaut n'est pas indexAction"
        );

        $this->assertEquals(
            [],
            $router->getActionParameters(),
            "La valeur par défaut n'est pas un tableau vide"
        );

    }

}