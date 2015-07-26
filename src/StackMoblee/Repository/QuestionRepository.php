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

    public function query($params) {

        $fields = [
            'q.question_id', 'q.title', 'q.owner_name', 'q.score',
            'q.creation_date', 'q.link', 'q.is_answered'
        ];

        $q = $this->createQueryBuilder('q')
            ->select($fields)
            ->where('q.score > ' . $params['score'])
            ->orderBy('q.' . $params['sort'], 'ASC');

        $paginator = new Paginator($q, false);
        $pagination = $paginator->getQuery()->getArrayResult();

        return $pagination;
    }

}