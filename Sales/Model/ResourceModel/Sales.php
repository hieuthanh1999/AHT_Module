<?php
namespace AHT\Sales\Model\ResourceModel;

class Sales extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('aht_sales', 'entity_id');
    }
}
