<?php
 
namespace AHT\Sales\Observer;
 
use Magento\Framework\Event\Observer;
 
class Save implements \Magento\Framework\Event\ObserverInterface
{

    protected $_checkoutSession;
    protected $_orderRepository ;

    public function __construct(\Magento\Checkout\Model\Session $checkoutSession,
                                \Magento\Sales\Model\Order $orderRepository
    )
    {
        $this->_checkoutSession = $checkoutSession;
        $this->_orderRepository = $orderRepository;
    }
    
    public function execute(Observer $observer)
    {
        // lấy dữ liệu từ checkout Session
        // $date = $this->_checkoutSession->getData('date');
		// $comment =$this->_checkoutSession->getData('comment');

        // echo $date;
        // echo $comment;
        // die;
        // $orderId = $observer->getEvent()->getOrderIds();
        // $order = $observer->getEvent()->getOrder();
        // $quote = $observer->getEvent()->getQuote();
        
        // $order->setData('delivery_date', $date);
        // $order->setData('delivery_comment', $comment);
        // $order->save();

        //thêm dữ liệu vào order
       
    }
}
