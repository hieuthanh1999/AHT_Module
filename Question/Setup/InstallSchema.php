<?php
namespace AHT\Question\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;

class InstallSchema implements InstallSchemaInterface
{
    public function install(
        \Magento\Framework\Setup\SchemaSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context
    )
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('aht_question')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('aht_question')
            )
                ->addColumn(
                    'question_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'QUESTION ID'
                )
                ->addColumn(
                    'name',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'NAME'
                )
                ->addColumn(
                    'email',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false],
                    'EMAIL'
                )
                ->addColumn(
                    'question',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    '64k',
                    ['nullable' => false],
                    'QUESTION'
                )
                ->setComment('Question Table');
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('aht_question'),
                $setup->getIdxName(
                    $installer->getTable('aht_question'),
                    ['name', 'email', 'question'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['name', 'email', 'question'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $installer->endSetup();
    }
}