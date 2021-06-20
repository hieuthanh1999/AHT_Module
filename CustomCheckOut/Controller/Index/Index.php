<?php
namespace AHT\CustomCheckOut\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_pageFactory;

     /**
     * @param \Magento\Framework\Serialize\Serializer\Json
     */
    private $_json;

    /**
     * @param \Magento\Framework\Controller\Result\JsonFactory
     */
    private $_jsonFactory;

    /**
     * @param \Magento\Checkout\Model\Session
     */
    private $_checkoutSession;


    protected $resultJsonFactory;

    private $quoteFactory;

    public function __construct(
       \Magento\Framework\App\Action\Context $context,
       \Magento\Framework\View\Result\PageFactory $pageFactory,
       \Magento\Framework\Serialize\Serializer\Json $json,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Quote\Model\QuoteFactory $quoteFactory
    )
    {

        $this->_json             = $json;
        $this->_jsonFactory      = $jsonFactory;
        $this->_checkoutSession  = $checkoutSession;
        $this->_pageFactory      = $pageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->quoteFactory   = $quoteFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getContent();
        $response = $this->_json->unserialize($data);

        $quote = $this->quoteFactory->create();
        $oj     = $quote->load($response['quoteId']);
        $oj->setData('delivery_date', $response['checkout-date']);
        $oj->setData('delivery_comment', $response['checkout-comment']);
        $quote->save($oj);

        return  var_dump($quote->getData('date'));
    }
}