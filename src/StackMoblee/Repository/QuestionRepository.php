<?php

/**
 * Created by PhpStorm.
 * User: mba
 * Date: 24/07/15
 * Time: 00:01
 */

namespace StackMoblee\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

//use Doctrine\Common\Collections\ArrayCollection;

class QuestionRepository extends EntityRepository
{
    /**
     * Manage get query for api
     * Note:
     * @param $params
     * @return array|bool
     */
    public function query($params) {
        $page = 1;
        $size = 99;

        $fields = [
            'q.question_id', 'q.title', 'q.owner_name', 'q.score',
            'q.creation_date', 'q.link', 'q.is_answered'
        ];

        if (!in_array('q.' . $params['sort'], $fields)) {
            return null;
        }

        $dql = $this->createQueryBuilder('q')
            ->select($fields)
            ->where('q.score > :score')
            ->orderBy('q.' . $params['sort'], ' DESC')
            ->setParameter(':score', $params['score']);

        if (!empty($params['page']) && !empty($params['rpp'])) {
            $page = $params['page'];
            $size = $params['rpp'];
        }
        return $this->queryPaginator($dql, $size, $page);
    }

    /**
     * @param $dql
     * @param int $size
     * @param int $current
     * @return Paginator
     */
    public function queryPaginator($dql, $size = null, $current = null) {
        $paginator = (new Paginator($dql))->getQuery();
        if (!empty($size) && !empty($current)) {
            $paginator->setFirstResult($size * ($current - 1))
                ->setMaxResults($size);
        }
        return $paginator->getArrayResult();
    }

}