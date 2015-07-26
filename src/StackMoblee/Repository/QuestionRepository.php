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
use Doctrine\Common\Collections\ArrayCollection;

class QuestionRepository extends EntityRepository
{
    /**
     * Manage get query for api
     * Note:
     * @param $params
     * @return array|bool
     */
    public function query($params) {

        $fields = [
            'q.question_id', 'q.title', 'q.owner_name', 'q.score',
            'q.creation_date', 'q.link', 'q.is_answered'
        ];

        if (!in_array('q.' . $params['sort'], $fields)) {
            return null;
        }

        $q = $this->createQueryBuilder('q')
            ->select($fields)
            ->where('q.score > :score')
            ->orderBy('q.' . $params['sort'], ' ASC')
            ->setParameter(':score', $params['score']);

        return (new Paginator($q, false))
            ->getQuery()
            ->getArrayResult();
    }

}