<?php

/**
 * StackToMoblee
 * @author: Marcelo Aymone
 * @category: Entity
 * Date: 23/07/15
 * Time: 23:34
 */
namespace StackMoblee\Question\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="StackMoblee\Question\Entity\QuestionRepository")
 * @ORM\Table(name="questions")
 */
class Question
{
    /** @Column(type="integer") * */
    public $question_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $owner_name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    public $score;

    /**
     * @ORM\Column(type="integer")
     */
    public $creation_date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $link;

    /** @Column(type="integer") * */
    public $is_answered;

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
        $this->owner_name = $owner['display_name'];
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