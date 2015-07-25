<?php
/**
 * Created by PhpStorm.
 * User: mba
 * Date: 24/07/15
 * Time: 21:25
 */

namespace StackMoblee\Controller;


use Silex\Application;
use StackMoblee\Entity\Question;
use StackMoblee\Service\QuestionService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

//use StackMoblee\Service\QuestionService;

class QuestionsController
{
    /**
     * Get Questions
     */
    public function get(Application $app, Request $request) {
//        $app['orm.em']->createQuery('SELECT * FROM StackMoblle\Entity\Question');
        $results = [];
        return new JsonResponse(['status' => $results]);
    }

    /**
     * Post Questions
     */
    public function post(Application $app, Request $request) {
        $data = json_decode($request->getContent(), true);

        $em = $app['orm.em'];
        $questionService = new QuestionService($em);
        $questions = $questionService->insert($data);
        return new JsonResponse([
            'success' => $questions,
            'msg' => 'question inserido com sucesso!'
        ]);
    }

}