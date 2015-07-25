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

class QuestionRepository extends EntityRepository
{

    public function query($params) {

        $dql = "SELECT * FROM Question";
        $query = $this->createQueryBuilder($dql)
            ->setFirstResult(1)
            ->setMaxResults(99);

        $paginator = new Paginator($query, false);

        return [
            'status' => true,
            'params' => $params,
            'paginate' => $paginator
        ];
    }

}