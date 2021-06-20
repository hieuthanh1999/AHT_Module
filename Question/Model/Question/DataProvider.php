<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Question\Model\Question;

use AHT\Question\Model\QuestionFactory;
use AHT\Question\Model\ResourceModel\Question\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\ObjectManager;
use AHT\Question\Model\Question\FileInfo;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Magento\Cms\Model\ResourceModel\Block\Collection
     */
    protected $collection;

    protected $questionFactory;

    protected $productRepository;
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;
    private $fileInfo;
    protected $_storeManager;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $colectionFactory,
        DataPersistorInterface $dataPersistor,
        QuestionFactory $questionFactory,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $colectionFactory->create();
        $this->questionFactory = $questionFactory;
        $this->productRepository = $productRepository;
        $this->dataPersistor = $dataPersistor;
        $this->_storeManager =  $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    

    public function convertValues($banner)
    {
        $fileName = $banner->getImages();
        $image = [];
        if ($this->getFileInfo()->isExist($fileName)) {
            $stat = $this->getFileInfo()->getStat($fileName);
            $mime = $this->getFileInfo()->getMimeType($fileName);
            $image[0]['name'] = $fileName;
            $image[0]['url'] = $this->_storeManager->getStore()->getBaseUrl()."pub/media/question/index/".$fileName;
            $image[0]['size'] = isset($stat) ? $stat['size'] : 0;
            $image[0]['type'] = $mime;
        }
        $banner->setImage($image);

        return $banner;
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $block) {
            $block = $this->convertValues($block);

            $this->loadedData[$block->getId()] = $block->getData();
        }

        $data = $this->dataPersistor->get('aht_question');
        if (!empty($data)) {
            $block = $this->collection->getNewEmptyItem();
            $block->setData($data);
            $this->loadedData[$block->getId()] = $block->getData();
            $this->dataPersistor->clear('aht_question');
        }
        return $this->loadedData;
    }

    private function getFileInfo()
    {
        if ($this->fileInfo === null) {
            $this->fileInfo = ObjectManager::getInstance()->get(FileInfo::class);
        }
        return $this->fileInfo;
    }
}