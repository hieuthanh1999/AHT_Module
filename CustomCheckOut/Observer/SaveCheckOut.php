<?php
 
namespace AHT\CustomCheckOut\Observer;
 
use Magento\Framework\Event\Observer;
 
class SaveCheckOut implements \Magento\Framework\Event\ObserverInterface
{

    protected $quoteFactory;

    public function __construct(
        \Magento\Quote\Model\QuoteFactory $quoteFactory
    )
    {
        $this->quoteFactory   = $quoteFactory;
    }
    
    public function execute(Observer $observer)
    {

        $order = $observer->getEvent()->getData('order');
        $quoteId = $order->getQuoteId();  
        $quoteFactory = $this->quoteFactory->create()->load($quoteId);

        $order->setData('delivery_date', $quoteFactory->getData('delivery_date'));
        $order->setData('delivery_comment', $quoteFactory->getData('delivery_comment'));
        $order->save();  
    }
}
