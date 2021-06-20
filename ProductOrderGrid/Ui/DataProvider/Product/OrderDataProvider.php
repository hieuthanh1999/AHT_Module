<?php
namespace AHT\ProductOrderGrid\Ui\DataProvider\Product;

use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Psr\Log\LoggerInterface as Logger;
use Magento\Framework\App\RequestInterface;
// use Magento\Framework\Api\Search\SearchResultInterface;

class OrderDataProvider extends \Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult
{
   /**
     * Value of seconds in one minute
     */
    const SECONDS_IN_MINUTE = 60;

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $date;

    /**
     * @var Visitor
     */
    protected $visitorModel;


    /**
     * @var RequestInterface
     * @since 100.1.0
     */
    protected $request;



    /**
     * @param EntityFactory $entityFactory
     * @param Logger $logger
     * @param FetchStrategy $fetchStrategy
     * @param EventManager $eventManager
     * @param string $mainTable
     * @param string $resourceModel
     * @param Visitor $visitorModel
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     */
    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $mainTable = 'sales_order',
        $resourceModel = 'Magento\Sales\Model\ResourceModel\Order',
        RequestInterface $request
    ) {
        $this->request = $request;
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel);
    }

    protected function _initSelect()
    {
        $productId = $this->request->getParam('id');
        $this->getSelect()
            ->from(['main_table' => 'sales_order'])
            ->joinRight('sales_order_item',
            'main_table.entity_id = sales_order_item.order_id');
        return $this;
    }
}