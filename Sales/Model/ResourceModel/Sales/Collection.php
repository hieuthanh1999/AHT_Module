<?php
namespace AHT\Sales\Model\ResourceModel\Sales;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'aht_sales_collection';
    protected $_eventObject = 'aht_sales_collection';

    /**
     * Define the resource model & the model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('AHT\Sales\Model\Sales', 'AHT\Sales\Model\ResourceModel\Sales');
    }
}