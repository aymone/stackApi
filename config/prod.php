<?php

// configure your app for the production environment

$app['debug'] = false;
$app['twig.path'] = array(__DIR__.'/../templates');
$app['twig.options'] = array('cache' => __DIR__.'/../var/cache/twig');


