<?php
/**
 * Created by PhpStorm.
 * User: mba
 * Date: 24/07/15
 * Time: 22:05
 */


namespace StackMoblee\Service;

use Doctrine\ORM\EntityManager;
use StackMoblee\Entity\Question;

class QuestionService
{
    /**
     * Entity
     * @var
     */
    private $question;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->questionsRepository = $this->em
            ->getRepository("\\StackMoblee\\Entity\\Question");
    }

    /**
     * Query
     * @param $params
     * @return mixed
     */
    public function find($params) {
        $params = $this->questionsRepository->query($params);
        return $params;
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