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
use StackMoblee\Entity\Update;

class QuestionService
{
    /**
     * Entity
     * @var
     */
    private $question;

    /**
     * Update entity
     * @var
     */
    private $update;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * Query
     * @param $params
     * @return mixed
     */
    public function find($params) {
        $questionsRepository = $this->em->getRepository("\\StackMoblee\\Entity\\Question");
        $questions = $questionsRepository->query($params);
        if (!empty($questions)) {
            return [
                'last_update' => $this->getLastUpdate(),
                'content' => $questions
            ];
        }
        return [
            'content' => false,
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
            $this->setUpdate();
            $response = [
                'last_update' => $this->setUpdate(),
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

    /**
     * SetUpdate
     * @return null|string
     */
    public function setUpdate() {
        $this->update = new Update();
        $this->em->persist($this->update);
        $this->em->flush();
        return !empty($this->update->created) ? $this->update->created : null;
    }

    /**
     * Get Last Update
     * @return null
     */
    public function getLastUpdate() {
        $last_update = $this->em->getRepository("\\StackMoblee\\Entity\\Update")->findOneBy([], ['created' => 'DESC']);
        return !empty($last_update->created) ? $last_update->created : null;
    }

    /**
     * Clean Questions table
     * @return mixed
     */
    public function clean() {
        $questionAlias = "\\StackMoblee\\Entity\\Question";
        $q = $this->em->createQuery("delete from $questionAlias m where 1=1");
        return $q->execute();
    }
}