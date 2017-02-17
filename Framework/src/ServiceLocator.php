<?php


namespace myProject\Framework;


class ServiceLocator
{

    private static $container = [];

    /**
     * Enregistrement d'un Service et de la Méthode permettant d'obtenir une instance de ce service
     * @param $serviceName
     * @param callable $callback
     */
    public static function register($serviceName, callable $callback)
    {
        self::$container[$serviceName] = $callback;
    }

    /**
     * Récupération de la valeur de retour du callback
     * référencé par le nom du Service
     * @param $serviceName
     * @return mixed
     */
    public static function get($serviceName)
    {
        if (array_key_exists($serviceName, self::$container)) {
            $callback = self::$container[$serviceName];
            return $callback();
        }
    }

}