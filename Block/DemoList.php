<?php
/**
 * List contents of genmato_demo table
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-11-12
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Block;

use Magento\Framework\View\Element\Template;
use Genmato\Sample\Model\ResourceModel\Demo\Collection as DemoCollection;
use Magento\Store\Model\ScopeInterface;

class DemoList extends Template
{
    /**
     * Demo collection
     *
     * @var DemoCollection
     */
    protected $_demoCollection;

    /**
     * Demo resource model
     *
     * @var \Genmato\Sample\Model\ResourceModel\Demo\CollectionFactory
     */
    protected $_demoColFactory;

    /**
     * @param Template\Context $context
     * @param \Genmato\Sample\Model\ResourceModel\Demo\CollectionFactory $collectionFactory
     * @param array $data
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Template\Context $context,
        \Genmato\Sample\Model\ResourceModel\Demo\CollectionFactory $collectionFactory,
        array $data = []
    ) {
        $this->_demoColFactory = $collectionFactory;
        parent::__construct(
            $context,
            $data
        );
    }

    /**
     * Get Header from configuration value
     * @return string
     */
    public function getHeader()
    {
        return $this->_scopeConfig->getValue('sample/demo/header', ScopeInterface::SCOPE_STORE);
    }

    /**
     * Get Demo Items Collection
     * @return DemoCollection
     */
    public function getDemoItems()
    {
        if (null === $this->_demoCollection) {
            $this->_demoCollection = $this->_demoColFactory->create();
        }
        return $this->_demoCollection;
    }
} 
