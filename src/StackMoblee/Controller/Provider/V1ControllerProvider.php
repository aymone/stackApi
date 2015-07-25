<?php

namespace StackMoblee\Controller\Provider;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class V1ControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get("/", "StackMoblee\\Controller\\V1Controller::index");

        return $controllers;
    }
}