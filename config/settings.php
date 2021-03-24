<?php

declare(strict_types = 1);

use DI\Container;
use Monolog\Logger;
use Dotenv\Dotenv as Dotenv;
return function (Container $container) {

    $dotenv = Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();

    $container->set('settings', function() {

        return [
            'name' => getenv("APPName"),
            'displayErrorDetails' => true,
            'logErrorDetails' => true,
            'logErrors' => true,
            'logger' => [
                'name' => getenv("APPName"),
                'path' => dirname(__DIR__) . "/logs/app.log",
                'level' => Logger::CRITICAL
            ],
            'views' => [
                'path' => dirname(__DIR__). "/templates",
                'settings' => [
                    'cache' => false
                ]
            ],
            'mailer' => [
                'username' => getenv("Mail_Username"),
                'password' => getenv("Mail_Password"),
                'From' => getenv("Mail_From_Address")
            ],
            'connection' => [
                'driver' => getenv("DBDriver"),
                'host' => getenv("DBHost"),
                'dbname' => getenv("DBName"),
                'dbuser' => getenv("DBUser"),
                'dbpass' => getenv("DBPassword"),
            ],
            'connection_joomla' => [
                'driver' => getenv("DBDriver_Joomla"),
                'host' => getenv("DBHOST_Joomla"),
                'dbname' => getenv("DBNAME_Joomla"),
                'dbuser' => getenv("DBUSER_Joomla"),
                'dbpass' => getenv("DBPASSWORD_Joomla"),
            ],
            'connection_indie' => [
                'driver' => getenv("DBDriver_Indie"),
                'host' => getenv("DBHOST_Indie"),
                'dbname' => getenv("DBNAME_Indie"),
                'dbuser' => getenv("DBUSER_Indie"),
                'dbpass' => getenv("DBPASSWORD_Indie"),
            ]
        ];

    });

};