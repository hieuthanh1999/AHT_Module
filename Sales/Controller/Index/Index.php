<?php

namespace AHT\Sales\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $connection;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Magento\Framework\App\ResourceConnection $resource
	) {
		$this->_pageFactory  = $pageFactory;
		$this->connection = $resource->getConnection();
		return parent::__construct($context);
	}

	public function execute()
	{
		$query = $this->connection->fetchAll("SELECT increment_id, store_name , created_at, billing_name, 
		shipping_name, base_grand_total,
		grand_total, status FROM sales_order_grid WHERE increment_id = 10");

	
		// foreach($query[0] as $key => $value)
		// {
		// 	$s = array($value);
		// }
		
		echo "<pre>";
		var_dump($query[0]['status']);
		echo "</pre>";
		echo "hi";
		die;
	//	$data = $this->getRequest()->getContent();
        // $response = $this->json->unserialize($data);
        // // /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        // //$resultJson = $this->resultJsonFactory->create();
		// $this->_checkoutSession->setData('date', $response['checkout-date']);
		// $this->_checkoutSession->setData('comment', $response['checkout-comment']);

		// chuyển kết quả về dạng object json và trả về cho ajax
		//return $resultJson->setData($response);
		
	}
}
