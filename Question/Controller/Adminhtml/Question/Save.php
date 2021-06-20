<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Question\Controller\Adminhtml\Question;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Backend\App\Action\Context;
use AHT\Question\Model\ResourceModel\Question as Resource;
use AHT\Question\Model\Question;
use AHT\Question\Model\QuestionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use AHT\Question\Model\Question\ImageUploader;


/**
 * Save CMS block action.
 */
class Save extends \AHT\Question\Controller\Adminhtml\Question implements HttpPostActionInterface
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var BlockFactory
     */
    private $questionFactory;

    /**
     * @var BlockRepositoryInterface
     */
    private $blockRepository;
    
    /**
     * @var ImageUploader
     */
    protected $imageUploader;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param DataPersistorInterface $dataPersistor
     * @param BlockFactory|null $blockFactory
     * @param BlockRepositoryInterface|null $blockRepository
     * @param ImageUploader $imageUploader
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        DataPersistorInterface $dataPersistor,
        QuestionFactory $questionFactory,
        ImageUploader $imageUploader,
        Resource $resource
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->questionFactory = $questionFactory;
        $this->resource = $resource;
        $this->imageUploader = $imageUploader;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            if (empty($data['question_id'])) {
                $data['question_id'] = null;
            }

            /** @var \Magento\Cms\Model\Block $model */
            $model = $this->questionFactory->create();

            $id = $this->getRequest()->getParam('question_id');
            if ($id) {
                try {
                    $this->resource->load($model, $id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This block no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }
            if (isset($data['image'][0]['name'])) {
                $imageName = $data['image'][0]['name'];
            }else{
                $imageName = '';
            }
            $data['images'] = $imageName;
            $model->setData($data);

            try {
                $this->resource->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the block.'));
                $this->dataPersistor->clear('aht_question');
                //move img
                if ($imageName){
                    $this->imageUploader->moveFileFromTmp($imageName);
                }

                return $this->processBlockReturn($model, $data, $resultRedirect);
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the block.'));
            }

            $this->dataPersistor->set('aht_question', $data);
            return $resultRedirect->setPath('*/*/edit', ['question_id' => $id]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Process and set the block return
     *
     * @param \Magento\Cms\Model\Block $model
     * @param array $data
     * @param \Magento\Framework\Controller\ResultInterface $resultRedirect
     * @return \Magento\Framework\Controller\ResultInterface
     */
    private function processBlockReturn($model, $data, $resultRedirect)
    {
        $redirect = $data['back'] ?? 'close';

        if ($redirect ==='continue') {
            $resultRedirect->setPath('*/*/edit', ['question_id' => $model->getId()]);
        } else if ($redirect === 'close') {
            $resultRedirect->setPath('*/*/');
        } 
        elseif ($redirect === 'next') {
            $resultRedirect->setPath('*/*/edit', ['question_id' => $this->getIndex($data['question_id'])]);
        }
        return $resultRedirect;
    }

    private function getIndex($id) {
        $collection = $this->questionFactory->create()->getCollection()->getAllIds();
        $index = array_search($id, $collection);
        $next = $index;
        $question = $this->questionFactory->create();
        if($index == (count($collection)-1)) {
            $next = 0;
        }
        else {
            $next = $index + 1;
        }
        return $question->load($collection[$next])->getId();
    }
}