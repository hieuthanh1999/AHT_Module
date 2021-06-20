<?php

namespace AHT\Question\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;


class Image extends \Magento\Ui\Component\Listing\Columns\Column
{


    /**
     * @var \PHPThanh\questionSlider\Model\question
     */
    protected $question;
    protected $_storeManager;
    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \PHPThanh\QuestionSlider\Model\Question $question
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        \AHT\Question\Model\Question $question,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
        $this->question = $question;
        $this->_storeManager = $storeManager;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {

        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                $question = new \Magento\Framework\DataObject($item);
                $item[$fieldName . '_src'] = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA)."question/index/".$question['images'];
                $item[$fieldName . '_orig_src'] = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA)."question/index/".$question['images'];
                $item[$fieldName . '_link'] = $this->urlBuilder->getUrl("questionadmin/question/edit",
                    ['id' => $question['id']]
                );
                $item[$fieldName . '_alt'] = $question['name'];
            }
        }

        return $dataSource;
    }
}