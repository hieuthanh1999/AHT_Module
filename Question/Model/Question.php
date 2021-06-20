<?php
namespace AHT\Question\Model;

use \Magento\Framework\DataObject\IdentityInterface;
use AHT\Question\Api\Data\QuestionInterface;

class Question extends \Magento\Framework\Model\AbstractModel  implements IdentityInterface, QuestionInterface
{

    const CACHE_TAG = 'aht_question_post';

    protected $_cacheTag = 'aht_question_post';

    protected $_eventPrefix = 'aht_question_post';

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource=null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection=null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * @return void
     */

    public function _construct()
    {
        $this->_init('AHT\Question\Model\ResourceModel\Question');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }


    public function getName()
    {
        return $this->getData("name");
    }

    public function getEmail()
    {
        return $this->getData("email");
    }

    public function getQuestion()
    {
        return $this->getData("question");
    }

    public function setName($name)
    {
        return $this->setData("name", $name);
    }

    public function setEmail($email)
    {
        return $this->setData("email", $email);
    }

    public function setQuestion($question)
    {
        return $this->setData("question", $question);
    }
}