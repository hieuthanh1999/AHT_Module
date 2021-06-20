<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\CustomCheckOut\Block\Adminhtml\Order;

/**
 * Edit order address form container block
 *
 * @api
 * @since 100.0.2
 */
class Delivery extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_order';
        $this->_mode = 'delivery';
        $this->_blockGroup = 'AHT_CustomCheckOut';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save Order Delivery'));
        $this->buttonList->remove('delete');
    }

    /**
     * Retrieve text for header element depending on loaded page
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        return __('Edit Order %1 %2 Address');
    }

    /**
     * Back button url getter
     *
     * @return string
     */
    public function getBackUrl()
    {
        $id = $this->getRequest()->getParam('order_id');
        return $this->getUrl('sales/*/view', ['order_id' =>  $id]);
    }
}
