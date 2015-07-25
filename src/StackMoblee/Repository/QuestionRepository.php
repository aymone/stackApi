<?php

/**
 * Created by PhpStorm.
 * User: mba
 * Date: 24/07/15
 * Time: 00:01
 */

namespace StackMoblee\Repository;

use Doctrine\ORM\EntityRepository;

//use Doctrine\ORM\Tools\Pagination\Paginator;

class QuestionRepository extends EntityRepository
{
    public function getQuestions() {
        $query = $this->createQueryBuilder("p")->getQuery()->getResult();
        return count($query);
    }

    public function postQuestions($questions) {

    }

}