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

    private $entityAlias = "\\StackMoblee\\Entity\\Question";

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em) {
        $this->em = $em;
        $this->questionsRepository = $this->em
            ->getRepository($this->entityAlias);
    }

    /**
     * Query
     * @param $params
     * @return mixed
     */
    public function find($params) {
        $questions = $this->questionsRepository->query($params);
        if (!empty($questions)) {
            return [
                'status' => true,
                'questions' => $questions
            ];
        }
        return [
            'status' => false,
            'msg' => 'Query Error'
        ];
    }

    /**
     * @param array $data
     * @return array
     */
    public function insert($data = []) {
        $this->em->getConnection()->beginTransaction();
        $this->clean();
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
            $this->em->getConnection()->commit();
        } catch (Exception $error) {
            $this->em->getConnection()->rollback();
            $response = [
                'status' => false,
                'msg' => 'Erro ao persistir dados! Erro: ' . $error->getMessage()
            ];
        }
        $this->em->clear();
        return $response;
    }

    public function clean() {
        $q = $this->em->createQuery("delete from $this->entityAlias m where 1=1");
        return $q->execute();
    }
}