<?php

/**
 * StackToMoblee
 * @author: Marcelo Aymone
 * @category: Entity
 * Date: 23/07/15
 * Time: 23:34
 */
namespace StackMoblee\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @Entity(repositoryClass="StackMoblee\Repository\QuestionRepository")
 * @Table(name="questions")
 */
class Question
{
    /**
     *
     * @Id @Column(type="integer")
     **/
    public $question_id;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    public $title;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    public $owner_name;

    /**
     * @Column(type="integer", nullable=true)
     */
    public $score;

    /**
     * @Column(type="integer")
     */
    public $creation_date;

    /**
     * @Column(type="string", length=255, nullable=true)
     */
    public $link;

    /**
     * @Column(type="integer")
     **/
    public $is_answered;

    /**
     * @param $data
     * Object Constructor
     */
    public function __construct($data = null) {
        if (!empty($data)) {
            $this->setQuestionId($data['question_id']);
            $this->setTitle($data['title']);
            $this->setOwnerName($data['owner']);
            $this->setScore($data['score']);
            $this->setCreationDate($data['creation_date']);
            $this->setLink($data['link']);
            $this->setIsAnswered($data['is_answered']);
        }
    }

    /**
     * @param mixed $question_id
     * @return Question
     */
    public function setQuestionId($question_id) {
        $this->question_id = $question_id;
        return $this;
    }

    /**
     * @param mixed $title
     * @return Question
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * @param mixed $owner
     * @return Question
     */
    public function setOwnerName($owner) {
        $this->owner_name = isset($owner['display_name']) ? $owner['display_name'] : null;
        return $this;
    }

    /**
     * @param mixed $score
     * @return Question
     */
    public function setScore($score) {
        $this->score = $score;
        return $this;
    }

    /**
     * @param mixed $creation_date
     * @return Question
     */
    public function setCreationDate($creation_date) {
        $this->creation_date = $creation_date;
        return $this;
    }

    /**
     * @param mixed $link
     * @return Question
     */
    public function setLink($link) {
        $this->link = $link;
        return $this;
    }

    /**
     * @param mixed $is_answered
     * @return Question
     */
    public function setIsAnswered($is_answered) {
        $this->is_answered = $is_answered;
        return $this;
    }

}