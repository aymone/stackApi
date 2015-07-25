<?php
/**
 * Created by PhpStorm.
 * User: mba
 * Date: 24/07/15
 * Time: 22:05
 */

namespace StackMoblee\Question\Service;

use Doctrine\ORM\EntityManager;
use StackMoblee\Question\Service;

class QuestionService
{

    public $app;
    private $question;

    public function __construct(EntityManager $em, Question $question) {
        $this->em = $em;
        $this->question = $question;
    }

    public function insert(array $data = array()) {
        $this->question->setNome($data['question_id']);
        $this->question->setValor($this->stringToMoney($data['valor']));
        $this->question->setDescricao($data['descricao']);
        $this->question->setImagem($data['fotos']);

        try {
            $this->em->persist($this->question);
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