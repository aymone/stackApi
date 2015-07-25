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

    public function __construct(EntityManager $em, Question $question) {
        $this->em = $em;
        $this->question = $question;
    }

    public function get() {
        return [
            status => true
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function insert(array $data = array()) {

        for ($i = 1; $i <= 99; $i++) {
            $this->question = new Question;
            $this->question->setQuestionId($data['question_id']);
            $this->question->setTitle($data['title']);
            $this->question->setOwnerName($data['owner']);
            $this->question->setScore($data['score']);
            $this->question->setCreationDate($data['creation_date']);
            $this->question->setLink($data['link']);
            $this->question->setIsAnswered($data['is_answered']);
            $this->em->persist($this->question);
        }
        try {
            $this->em->flush();
        } catch (\Exception $error) {
            return [
                'success' => false,
                'msg' => 'Erro ao inserir question! Erro: ' . $error->getMessage()
            ];
        }

        return [
            'success' => true,
            'msg' => 'question inserido com sucesso!',
            'question' => [
                'id' => $this->question->getId()
            ]
        ];

    }
}