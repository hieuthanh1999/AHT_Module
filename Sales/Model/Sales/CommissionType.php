<?php
namespace AHT\Sales\Model\Sales;

use Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory;
use Magento\Framework\DB\Ddl\Table;


class CommissionType extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{

protected $optionFactory;


public function getAllOptions()
{

    $this->_options=[ ['label'=>'     ', 'value'=>''],
                      ['label'=>'Fixed', 'value'=>'0'],
                      ['label'=>'Percent', 'value'=>'1'],
                     ];
    return $this->_options;
}


public function getOptionText($value)
{
    foreach ($this->getAllOptions() as $option) 
    {
        if ($option['value'] == $value) {
            return $option['label'];
        }
    }
    return false;
}


public function getFlatColumns()
{
    $attributeCode = $this->getAttribute()->getAttributeCode();
    return [
        $attributeCode => [
            'unsigned' => true,
            'default' => null,
            'extra' => null,
            'type' => Table::TYPE_INTEGER,
            'nullable' => true,
            'comment' => 'Product Attribute Options  ' . $attributeCode . ' column',
        ],
    ];
}
}