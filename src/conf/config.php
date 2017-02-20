<?php

// Imports
use myProject\Framework\ServiceLocator;
use myProject\Forum\Models\PersonneDAO;

ServiceLocator::register(
    'pdo.association',
    function () {
        $dns = "mysql:host=localhost; dbname=association; charset=utf8";
        $options = [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION];

        return new \PDO($dns, 'root', '', $options);
    }
);

ServiceLocator::register(
    'dao.personne',
    function () {
        $pdo = ServiceLocator::get('pdo.association');

        return new PersonneDAO($pdo);
    }
);