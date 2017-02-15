<?php

namespace myProject\Framework;

interface IRouter
{
    /**
     * @return string
     */
    public function getControllerName(): string;

    /**
     * @param string $controllerName
     * @return Router
     */
    public function setControllerName(string $controllerName): Router;

    /**
     * @return string
     */
    public function getActionName(): string;

    /**
     * @param string $actionName
     * @return Router
     */
    public function setActionName(string $actionName): Router;

    /**
     * @return array
     */
    public function getActionParameters(): array;

    /**
     * @param array $actionParameters
     * @return Router
     */
    public function setActionParameters(array $actionParameters): Router;

    /**
     * @return mixed
     */
    public function getUrl();

    /**
     * @param mixed $url
     * @return Router
     */
    public function setUrl($url);
}