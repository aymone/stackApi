<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\RoutingServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\DoctrineServiceProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;

$app = new Application();
$app->register(new RoutingServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new TwigServiceProvider());

$app->register(new DoctrineServiceProvider(), [
    'db.options' => [
        'driver' => 'pdo_mysql',
        'host' => 'localhost',
        'dbname' => 'stack_moblee',
        'user' => 'root',
        'password' => '123',
        'charset' => 'utf8'
    ]
]);

$app->register(new DoctrineOrmServiceProvider, [
    "orm.em.options" => [
        "mappings" => [
            [
                "type" => "annotation",
                "namespace" => 'StackMoblee\Entity',
                "path" => __DIR__ . "/src/StackMoblee/Entity",
            ]
        ]
    ]
]);

$app->register(new MonologServiceProvider(), [
    'monolog.logfile' => __DIR__ . '/../var/logs/silex_dev.log',
]);

$app->mount("/stack_moblee/v1", new \StackMoblee\Provider\StackMobleeControllerProvider());

return $app;
