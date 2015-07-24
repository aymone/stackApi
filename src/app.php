<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\RoutingServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\HttpFragmentServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Dflydev\Provider\DoctrineOrm\DoctrineOrmServiceProvider;

$app = new Application();
$app->register(new RoutingServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new TwigServiceProvider());
$app->register(new HttpFragmentServiceProvider());
$app->register(new Silex\Provider\DoctrineServiceProvider(), [
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
//    "orm.proxies_dir" => "/path/to/proxies",
    "orm.em.options" => [
        "mappings" => [
            [
                "type" => "annotation",
                "namespace" => 'StackMoblee\Questions',
                "path" => __DIR__ . "/src/Questions/Entities",
            ]
        ]
    ]
]);
$app['orm.ems.default'] = 'mysql';

$app->register(new MonologServiceProvider(), [
    'monolog.logfile' => __DIR__ . '/../var/logs/silex_dev.log',
]);

$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...
    $twig->addFunction(new \Twig_SimpleFunction('asset', function ($asset) use ($app) {
        return $app['request_stack']->getMasterRequest()->getBasepath() . '/' . ltrim($asset, '/');
    }));
    return $twig;
});

return $app;
