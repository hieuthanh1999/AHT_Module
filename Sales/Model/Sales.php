<?php
namespace AHT\Sales\Model;


class Sales extends \Magento\Framework\Model\AbstractModel
{

    const CACHE_TAG = 'aht_sales';

    protected $_cacheTag = 'aht_sales';

    protected $_eventPrefix = 'aht_sales';

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
        $this->_init('AHT\Sales\Model\ResourceModel\Sales');
    }
}