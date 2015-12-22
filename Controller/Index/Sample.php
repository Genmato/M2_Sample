<?php
/**
 * Controller to render [url]/sample/index/sample
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-11-12
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Genmato\Sample\Model\Sample\DataFactory;

class Sample extends Action
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /** @var  DataFactory $dataReader */
    private $dataReader;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param DataFactory $dataReader
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        DataFactory $dataReader
    )
    {
        $this->dataReader = $dataReader;
        parent::__construct($context);
    }

    /**
     * Renders Sample
     */
    public function execute()
    {
        $myConfig = $this->dataReader->create();
        print_r($myConfig->get());
    }
} 
