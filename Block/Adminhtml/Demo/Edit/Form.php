<?php
/**
 * Edit demo item form
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-11-16
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Block\Adminhtml\Demo\Edit;

use Magento\Customer\Controller\RegistryConstants;
use Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{

    /**
     * @var \Genmato\Sample\Model\DemoFactory
     */
    protected $demoDataFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Genmato\Sample\Model\DemoFactory $demoDataFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Genmato\Sample\Model\DemoFactory $demoDataFactory,
        array $data = []
    ) {
        $this->demoDataFactory = $demoDataFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form for render
     *
     * @return void
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $demoId = $this->_coreRegistry->registry('current_demo_id');
        /** @var \Genmato\Sample\Model\DemoFactory $demoData */
        if ($demoId === null) {
            $demoData = $this->demoDataFactory->create();
        } else {
            $demoData = $this->demoDataFactory->create()->load($demoId);
        }

        $yesNo = [];
        $yesNo[0] = 'No';
        $yesNo[1] = 'Yes';

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Basic Information')]);

        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'title' => __('Title'),
                'required' => true
            ]
        );

        $fieldset->addField(
            'is_active',
            'select',
            [
                'name' => 'is_active',
                'label' => __('Active'),
                'title' => __('Active'),
                'class' => 'required-entry',
                'required' => true,
                'values' => $yesNo,
            ]
        );

        $fieldset->addField(
            'is_visible',
            'select',
            [
                'name' => 'is_visible',
                'label' => __('Visible'),
                'title' => __('Visible'),
                'class' => 'required-entry',
                'required' => true,
                'values' => $yesNo,
            ]
        );

        if ($demoData->getId() !== null) {
            // If edit add id
            $form->addField('demo_id', 'hidden', ['name' => 'demo_id', 'value' => $demoData->getId()]);
        }

        if ($this->_backendSession->getDemoData()) {
            $form->addValues($this->_backendSession->getDemoData());
            $this->_backendSession->setDemoData(null);
        } else {
            $form->addValues(
                [
                    'id' => $demoData->getId(),
                    'title' => $demoData->getTitle(),
                    'is_active' => $demoData->getIsActive(),
                    'is_visible' => $demoData->getIsVisible(),
                ]
            );
        }

        $form->setUseContainer(true);
        $form->setId('edit_form');
        $form->setAction($this->getUrl('*/*/save'));
        $form->setMethod('post');
        $this->setForm($form);
    }
}
