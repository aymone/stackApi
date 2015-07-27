<?php

namespace StackMoblee\Provider;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class StackMobleeControllerProvider implements ControllerProviderInterface
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
         * Get Questions route
         */
        $controllers->get("/questions", "StackMoblee\\Controller\\QuestionsController::get");

        /**
         * Post Questions route
         */
        $controllers->post("/questions", "StackMoblee\\Controller\\QuestionsController::post");

        return $controllers;
    }
}