<?php
namespace AHT\Question\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $_questionFactory;

    public function __construct(\AHT\Question\Model\QuestionFactory $questionFactory)
    {
        $this->_questionFactory = $questionFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

        $data = [
            'name'      => "Name test", 
            'email'     => "Test@gmail.com",
            'question'  => "What?"
        ];
        $question = $this->_questionFactory->create();
        $question->addData($data)->save();
    }
}
?>
