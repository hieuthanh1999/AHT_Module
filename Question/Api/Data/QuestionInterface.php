<?php
namespace AHT\Question\Api\Data;

interface QuestionInterface
{
    /**
    * Get question name
    *
    * @return string|null
    */

    public function getName();

    /**
    * Get question name
    *
    * @return string|null
    */

    public function getEmail();
    /**
    * Get question name
    *
    * @return string|null
    */


    public function getQuestion();

    /**
     * Get question name
     *
     * @return string|null
     */

    public function setName($name);

    /**
    * Get question name
    *
    * @return string|null
    */

    public function setEmail($email);

    /**
    * Get question name
    *
    * @return string|null
    */

    public function setQuestion($question);
}
