<?php

namespace AHT\Question\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeData implements UpgradeDataInterface
{
	protected $_postFactory;

	public function __construct(\AHT\Question\Model\QuestionFactory $postFactory)
	{
		$this->_postFactory = $postFactory;
	}

	public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		if (version_compare($context->getVersion(), '1.0.3', '<')) {
			$data = [
                'name'      => "Name test", 
                'email'     => "Test@gmail.com",
                'question'  => "What?",
                'images'    => "test.jpg"
			];
			$post = $this->_postFactory->create();
			$post->addData($data)->save();
		}
		$setup->startSetup();

        /*if (version_compare($context->getVersion(), '1.0.2', '<')) {
            $setup->getConnection()->update(
                $setup->getTable('AHT_Stock'),
                [
                    'description' => 'Default description'
                ],
                $setup->getConnection()->quoteInto('id = ?', 1)
            );
        }
        $setup->endSetup();*/
	}
}