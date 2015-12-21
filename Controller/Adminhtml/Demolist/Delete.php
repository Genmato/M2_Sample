<?php
/**
 * Delete controller
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-11-13
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Controller\Adminhtml\Demolist;

use Magento\Backend\App\Action;

class Delete extends Action
{
    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Genmato_Sample::demolist');
    }

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('demo_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $title = "";
            try {
                // init model and delete
                $model = $this->_objectManager->create('Genmato\Sample\Model\Demo');
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccess(__('The item has been deleted.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['demo_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find a listing to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
} 
