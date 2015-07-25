<?php

namespace StackMoblee\Provider;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class QuestionsControllerProvider implements ControllerProviderInterface
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
        $controllers->get("/questions", "StackMoblee\\Controller\\QuestionsController::get");

        /**
         * Post route
         */
        $controllers->post("/questions", "StackMoblee\\Controller\\QuestionsController::post");
        return $controllers;
    }
}