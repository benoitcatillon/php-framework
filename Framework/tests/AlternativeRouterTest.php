<?php

include 'vendor/autoload.php';

use myProject\Framework\Router;


class AlternativeRouterTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Méthode appelée juste après l'instanciation de la classe test
     */
    public function setUp()
    {

    }

    /**
     * Méthode appelée juste avant la destruction de la classe test
     */
    public function tearDown()
    {

    }

    public function controllerProvider()
    {

        return [
            ['/', 'DefaultController'],
            [null, 'DefaultController'],
            ['/test', 'TestController'],
            ['/test/action', 'TestController'],
            ['/test/action/2', 'TestController']
        ];

    }

    /**
     * @dataProvider controllerProvider
     * @param $input
     * @param $output
     */
    public function testController($input, $output)
    {

        $router = new Router($input);
        $this->assertEquals($output, $router->getControllerName());

    }


    public function actionProvider()
    {

        return [
            ['/', 'indexAction'],
            [null, 'indexAction'],
            ['/test', 'indexAction'],
            ['/test/test', 'testAction'],
            ['/test/test/2', 'testAction'],
            ['/test/test-a-la-con', 'testALaConAction']
        ];

    }

    /**
     * @dataProvider ActionProvider
     * @param $input
     * @param $output
     */
    public function testAction($input, $output)
    {

        $router = new Router($input);
        $this->assertEquals($output, $router->getActionName());

    }

}
