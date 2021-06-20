<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Question\Controller\Adminhtml\Question;

use Magento\Framework\App\Action\HttpPostActionInterface;

class Delete extends \Magento\Cms\Controller\Adminhtml\Block implements HttpPostActionInterface
{
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('question_id');
        if ($id) {
            try {
                $model = $this->_objectManager->create(\AHT\Question\Model\Question::class);
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccessMessage(__('You have deleted the question.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a block to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}