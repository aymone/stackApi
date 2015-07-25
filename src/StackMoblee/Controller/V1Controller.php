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

class V1Controller
{
    /**
     * Get Questions
     */
    public function getQuestions(Application $app, Request $request) {
//        $app['orm.em']->createQuery('SELECT * FROM StackMoblle\Entity\Question');
        $results = [];
        return new JsonResponse(['status' => $results]);
    }

    /**
     * Post Questions
     */
    public function postQuestions(Application $app, Request $request) {
        $data = json_decode($request->getContent(), true);
        for ($i = 0; $i <= 98; $i++) {
            $question = new Question;
            $question->setQuestionId($data[$i]['question_id']);
            $question->setTitle($data[$i]['title']);
            $question->setOwnerName($data[$i]['owner']);
            $question->setScore($data[$i]['score']);
            $question->setCreationDate($data[$i]['creation_date']);
            $question->setLink($data[$i]['link']);
            $question->setIsAnswered($data[$i]['is_answered']);
            $app['orm.em']->persist($question);
        }
        try {
            $app['orm.em']->flush();
        } catch (\Exception $error) {
            return new JsonResponse([
                'success' => false,
                'msg' => 'Erro ao inserir question! Erro: ' . $error->getMessage()
            ]);
        }

        return new JsonResponse([
            'success' => true,
            'msg' => 'question inserido com sucesso!'
        ]);
    }

}