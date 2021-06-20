<?php
namespace AHT\CustomerAttribute\Model\Source;

use Magento\Eav\Model\ResourceModel\Entity\Attribute\OptionFactory;


class CompanyType extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{

protected $optionFactory;


public function getAllOptions()
{

    $this->_options=[ ['label'=>'--------- Company Type ----------','value'=>''],
                      ['label'=>'CBD Manufacturer',                 'value'=>'0'],
                      ['label'=>'CBD Brand and Marketing company',  'value'=>'1'],
                      ['label'=>'CBD Extractor',                    'value'=>'2'],
                      ['label'=>'Other',                            'value'=>'3'],
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
}