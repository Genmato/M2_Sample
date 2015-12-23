<?php
/**
 * Controller to render [url]/sample/index/test
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
use Magento\Framework\Api\SearchCriteriaBuilder;
use Genmato\Sample\Api\DemoRepositoryInterface;
use Genmato\Sample\Model\Data\DemoFactory;
use Genmato\Sample\Api\Data\DemoInterface;

class Test extends Action
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /** @var  DemoRepositoryInterface */
    private $demoRepository;

    /** @var DemoFactory  */
    private $demo;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;
    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param DemoRepositoryInterface $demoRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param DemoFactory $demoFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        DemoRepositoryInterface $demoRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        DemoFactory $demoFactory
    )
    {
        $this->demoRepository = $demoRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->demo = $demoFactory;
        parent::__construct($context);
    }

    /**
     * Renders Sample
     */
    public function execute()
    {
        echo '<pre>';

        // Create new record thru service layer/contract

        /** @var DemoInterface $demoRecord */
        $demoRecord = $this->demo->create();
        $demoRecord->setIsActive(1)
            ->setIsVisible(1)
            ->setTitle('Test thru Service Layer');

        $demo = $this->demoRepository->save($demoRecord);
        print_r($demo);

        // Get list of available records
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchResult = $this->demoRepository->getList($searchCriteria);
        foreach ($searchResult->getItems() as $item) {
            echo $item->getId().' => '.$item->getTitle().'<br>';
        }
    }

} 
