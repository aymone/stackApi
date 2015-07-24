<?php

/**
 * StackToMoblee
 * @author: Marcelo Aymone
 * @category: Entity
 * Date: 23/07/15
 * Time: 23:34
 */

/**
 * @Entity @Table(name="questions")
 **/
class Question
{
    /** @Column(type="integer") **/
    public $question_id;

    /** @Column(type="string") **/
    public $title;

    /** @Column(type="string") **/
    public $owner_name;

    /** @Column(type="integer") **/
    public $score;

    /** @Column(type="string") **/
    public $link;

    /** @Column(type="integer") **/
    public $is_answered;

    /**
     * @return mixed
     */
    public function getQuestionId() {
        return $this->question_id;
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
     * @return mixed
     */
    public function getTitle() {
        return $this->title;
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
     * @return mixed
     */
    public function getOwnerName() {
        return $this->owner_name;
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
     * @return mixed
     */
    public function getScore() {
        return $this->score;
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
     * @return mixed
     */
    public function getLink() {
        return $this->link;
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
     * @return mixed
     */
    public function getIsAnswered() {
        return $this->is_answered;
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