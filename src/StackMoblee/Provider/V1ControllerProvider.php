<?php

namespace StackMoblee\Provider;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class V1ControllerProvider implements ControllerProviderInterface
{
    /**
     * Provider connector
     * @param Application $app
     * @return mixed
     */
    public function connect(Application $app) {
        /**
         * Register factories
         */
        $controllers = $app['controllers_factory'];

        /**
         * Get route
         */
        $controllers->get("/questions", "StackMoblee\\Controller\\V1Controller::getQuestions");

        /**
         * Post route
         */
        $controllers->post("/questions", "StackMoblee\\Controller\\V1Controller::postQuestions");
        return $controllers;
    }
}