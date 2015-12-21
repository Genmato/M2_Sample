<?php
/**
 * Form container for Demo edit/new
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-11-16
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Block\Adminhtml\Demo;

use Magento\Backend\Block\Widget\Form\Container;

class Edit extends Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry;

    /**
     * Current demo record id
     *
     * @var bool|int
     */
    protected $demoId=false;

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Remove Delete button if record can't be deleted.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'demo_id';
        $this->_controller = 'adminhtml_demo';
        $this->_blockGroup = 'Genmato_Sample';

        parent::_construct();

        $demoId = $this->getDemoId();
        if (!$demoId) {
            $this->buttonList->remove('delete');
        }
    }

    /**
     * Retrieve the header text, either editing an existing record or creating a new one.
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        $demoId = $this->getDemoId();
        if (!$demoId) {
            return __('New DemoList Item');
        } else {
            return __('Edit DemoList Item');
        }
    }

    public function getDemoId()
    {
        if (!$this->demoId) {
            $this->demoId=$this->coreRegistry->registry('current_demo_id');
        }
        return $this->demoId;
    }

}
