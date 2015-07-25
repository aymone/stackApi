<?php
/**
 * Created by PhpStorm.
 * User: mba
 * Date: 24/07/15
 * Time: 21:25
 */

namespace StackMoblee\Controller;

use Silex\Application;
use StackMoblee\Service\QuestionService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Class QuestionsController
 * @package StackMoblee\Controller
 */
class QuestionsController
{
    /**
     * @param Request $request
     * @param Application $app
     * @return JsonResponse
     */
    public function get(Request $request, Application $app) {
        //Query params from client
        $params = $request->query->all();
        $em = $app['orm.em'];
        $questionService = new QuestionService($em);
        $response = $questionService->find($params);
        return new JsonResponse($response);
    }

    /**
     * @param Request $request
     * @param Application $app
     * @return JsonResponse
     */
    public function post(Request $request, Application $app) {
        $data = json_decode($request->getContent(), true);
        $em = $app['orm.em'];
        $questionService = new QuestionService($em);
        $response = $questionService->insert($data);
        return new JsonResponse($response);
    }

}