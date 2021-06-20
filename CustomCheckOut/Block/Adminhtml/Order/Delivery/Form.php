<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\CustomCheckOut\Block\Adminhtml\Order\Delivery;

use Magento\Framework\Pricing\PriceCurrencyInterface;

/**
 * Adminhtml sales order address block
 * @SuppressWarnings(PHPMD.DepthOfInheritance)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Form extends \Magento\Sales\Block\Adminhtml\Order\Create\Form\AbstractForm
{
    /**
     * Address form template
     *
     * @var string
     */
    protected $_template = 'AHT_CustomCheckOut::order/delivery/delivery_form.phtml';

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    protected $_order;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Model\Session\Quote $sessionQuote
     * @param \Magento\Sales\Model\AdminOrder\Create $orderCreate
     * @param PriceCurrencyInterface $priceCurrency
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Framework\Reflection\DataObjectProcessor $dataObjectProcessor
     * @param \Magento\Directory\Helper\Data $directoryHelper
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param \Magento\Customer\Model\Metadata\FormFactory $customerFormFactory
     * @param \Magento\Customer\Model\Options $options
     * @param \Magento\Customer\Helper\Address $addressHelper
     * @param \Magento\Customer\Api\AddressRepositoryInterface $addressService
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $criteriaBuilder
     * @param \Magento\Framework\Api\FilterBuilder $filterBuilder
     * @param \Magento\Customer\Model\Address\Mapper $addressMapper
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Model\Session\Quote $sessionQuote,
        \Magento\Sales\Model\AdminOrder\Create $orderCreate,
        PriceCurrencyInterface $priceCurrency,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Framework\Reflection\DataObjectProcessor $dataObjectProcessor,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Customer\Model\Metadata\FormFactory $customerFormFactory,
        \Magento\Customer\Model\Options $options,
        \Magento\Customer\Api\AddressRepositoryInterface $addressService,
        \Magento\Framework\Api\SearchCriteriaBuilder $criteriaBuilder,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        \Magento\Customer\Model\Address\Mapper $addressMapper,
        \Magento\Sales\Model\OrderFactory $orderFactory,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_order        = $orderFactory;
        parent::__construct(
            $context,
            $sessionQuote,
            $orderCreate,
            $priceCurrency,
            $formFactory,
            $dataObjectProcessor,
            $data
        );
    }

    /**
     * Order address getter
     *
     * @return \Magento\Sales\Model\Order\Address
     */
    protected function _getAddress()
    {
        return $this->_coreRegistry->registry('order_delivery');
    }

    /**
     * Define form attributes (id, method, action)
     *
     * @return $this
     */
    protected function _prepareForm()
    {

        $fieldset = $this->_form->addFieldset('main', ['no_container' => true]);

        $fieldset->addField(
            'delivery_date',
            'date',
            [
                'name' => 'delivery_date',
                'label' => __('Delivery date'),
                'value' => $this->getOrder()->getData('delivery_date'),
                'date_format' => 'yyyy-MM-dd',
            ]
        );
        $this->_form->setId('edit_form');
        $this->_form->setMethod('post');
        $this->_form->setAction(
            $this->getUrl('sales/*/deliverysave', ['order_id' =>$this->getOrderId()])
        );
        $this->_form->setUseContainer(true);

        return $this;
    }

    /**
     * Form header text getter
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        return __('Order Delivery Information');
    }

    /**
     * Return Form Elements values
     *
     * @return array
     */
    public function getFormValues()
    {
        return $this->_getAddress()->getData();
    }

    /**
     * @inheritDoc
     */
    protected function getAddressStoreId()
    {
        return $this->_getAddress()->getOrder()->getStoreId();
    }


    public function getOrderId()
    {
        return $this->getRequest()->getParam('order_id');
    }
    public function getOrder()
    {
        $id = $this->getOrderId();
        $order = $this->_order->create()->load($id);
        return $order;
    }
}
