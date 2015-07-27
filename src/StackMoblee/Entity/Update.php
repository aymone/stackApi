<?php

/**
 * StackToMoblee
 * @author: Marcelo Aymone
 * @category: Entity
 * Date: 23/07/15
 * Time: 23:34
 */
namespace StackMoblee\Entity;

/**
 * @Entity(repositoryClass="StackMoblee\Repository\UpdateRepository")
 * @Table(name="updates")
 */
class Update
{
    /**
     * @Id @Column(type="integer")
     * @GeneratedValue
     **/
    public $id;

    /**
     * @Column(type="integer", length=10)
     */
    public $created;

    /**
     * Object Constructor
     */
    public function __construct() {
        $this->created = (new \DateTime())->format('U');
    }

}