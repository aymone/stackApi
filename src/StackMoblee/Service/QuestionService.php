<?php
/**
 * Created by PhpStorm.
 * User: mba
 * Date: 24/07/15
 * Time: 22:05
 */


namespace StackMoblee\Service;

use Silex\Application;
use Doctrine\ORM\EntityManager;
use StackMoblee\Entity\Question;

class QuestionService
{

    public $app;
    private $question;

    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->question = new Question;
    }

    public function get() {
        return [
            'status' => true
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function insert($data = []) {
        for ($i = 0; $i <= 98; $i++) {
            $this->question = new Question;
            $this->question->setQuestionId($data[$i]['question_id']);
            $this->question->setTitle($data[$i]['title']);
            $this->question->setOwnerName($data[$i]['owner']);
            $this->question->setScore($data[$i]['score']);
            $this->question->setCreationDate($data[$i]['creation_date']);
            $this->question->setLink($data[$i]['link']);
            $this->question->setIsAnswered($data[$i]['is_answered']);
            $this->em->persist($this->question);
        }
        try {
            $this->em->flush();
            $this->em->clear();
        } catch (Exception $error) {
            return new JsonResponse([
                'success' => false,
                'msg' => 'Erro ao persistir dados! Erro: ' . $error->getMessage()
            ]);
        }
        return [
            'success' => true,
            'msg' => 'Dados persistidos com sucesso!'
        ];
    }
}