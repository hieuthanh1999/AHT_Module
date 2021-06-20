<?php
namespace AHT\CustomCheckOut\Block\Adminhtml\Order\View;

Class DeliveryBlock extends \Magento\Framework\View\Element\Template
{
    protected $_checkoutSession;

    /**
     * @param \Magento\Sales\Model\Order
     */
    private $_order;

    public function __construct(
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Sales\Model\Order $order,
        array $data = []
    ) {
        $this->_order = $order;
        $this->_checkoutSession = $checkoutSession;
        parent::__construct($context, $data);
    }
    public function getOrder()
    {
        $id = $this->getId();
        $order = $this->_order->load($id);
        return $order;
    }

    public function getId(){
        return $this->getRequest()->getParam('order_id');
    }
        /**
     * Get link to edit order delivery page
     *
     * @param \Magento\Sales\Model\Order\Address $address
     * @param string $label
     * @return string
     */
    public function getDeliveryEditLink($label = '')
    {
        // if ($this->_authorization->isAllowed('Magento_Sales::actions_edit')) {
            if (empty($label)) {
                $label = __('Edit');
            }
            $url = $this->getUrl('sales/order/delivery', ['order_id' => $this->getId()]);
            return '<a href="' . $this->escapeUrl($url) . '">' . $this->escapeHtml($label) . '</a>';
       // }

        return '';
    }
}