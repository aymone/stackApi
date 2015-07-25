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
        $this->question = new Question();
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
        try {
            for ($i = 0; $i <= 98; $i++) {
                $this->question = new Question($data[$i]);
                $this->em->persist($this->question);
            }
            $this->em->flush();
            $response = [
                'status' => true,
                'msg' => 'Dados persistidos com sucesso!',

            ];
        } catch (Exception $error) {
            $response = [
                'status' => false,
                'msg' => 'Erro ao persistir dados! Erro: ' . $error->getMessage()
            ];
        }
        $this->em->clear();
        return $response;
    }

    public function clean() {

    }
}