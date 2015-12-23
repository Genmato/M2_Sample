<?php
/**
 * Sample
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-12-22
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Model\ResourceModel;

use Genmato\Sample\Model\DemoRegistry;
use Genmato\Sample\Model\DemoFactory;
use Genmato\Sample\Api\Data\DemoInterface;
use Genmato\Sample\Api\Data\DemoInterfaceFactory;
use Genmato\Sample\Api\Data\DemoExtensionInterface;
use Genmato\Sample\Api\Data\DemoSearchResultsInterfaceFactory;
use Genmato\Sample\Model\Demo;
use Genmato\Sample\Model\ResourceModel\Demo as DemoResource;
use Genmato\Sample\Model\ResourceModel\Demo\Collection;
use Genmato\Sample\Api\DemoRepositoryInterface;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\ExtensionAttribute\JoinProcessorInterface;

class DemoRepository implements DemoRepositoryInterface
{

    /** @var DemoRegistry  */
    private $demoRegistry;

    /** @var DemoFactory  */
    private $demoFactory;

    /** @var DemoInterfaceFactory  */
    private $demoDataFactory;

    /** @var  Demo */
    private $demoResourceModel;

    /**
     * @var DataObjectProcessor
     */
    private $dataObjectProcessor;

    /**
     * @var DemoSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var JoinProcessorInterface
     */
    protected $extensionAttributesJoinProcessor;

    /**
     * @param DemoRegistry $demoRegistry
     * @param DemoFactory $demoFactory
     * @param DemoInterfaceFactory $demoDataFactory
     * @param DemoResource $demoResourceModel
     * @param DataObjectProcessor $dataObjectProcessor
     * @param DemoSearchResultsInterfaceFactory $searchResultsFactory
     * @param JoinProcessorInterface $extensionAttributesJoinProcessor
     */
    public function __construct(
        DemoRegistry $demoRegistry,
        DemoFactory $demoFactory,
        DemoInterfaceFactory $demoDataFactory,
        DemoResource $demoResourceModel,
        DataObjectProcessor $dataObjectProcessor,
        DemoSearchResultsInterfaceFactory $searchResultsFactory,
        JoinProcessorInterface $extensionAttributesJoinProcessor
    ) {
        $this->demoRegistry = $demoRegistry;
        $this->demoFactory = $demoFactory;
        $this->demoDataFactory = $demoDataFactory;
        $this->demoResourceModel = $demoResourceModel;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->extensionAttributesJoinProcessor = $extensionAttributesJoinProcessor;
    }
    /**
     * {@inheritdoc}
     */
    public function save(DemoInterface $demo)
    {
        /** @var Demo $demoModel */
        $demoModel = $this->demoFactory->create();

        if ($demo->getId()) {
            $demoModel->load($demo->getId());
        }
        $demoModel
            ->setTitle($demo->getTitle())
            ->setIsVisible($demo->getIsVisible())
            ->setIsActive($demo->getIsActive());

        try {
            $demoModel->save();
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
        return $demoModel->getData();
    }

    /**
     * {@inheritdoc}
     */
    public function getById($id)
    {
        $demoModel = $this->demoRegistry->retrieve($id);
        $demoDataObject = $this->demoDataFactory->create()
            ->setId($demoModel->getId())
            ->setTitle($demoModel->getTitle())
            ->setCreationTime($demoModel->getCreationTime())
            ->setUpdateTime($demoModel->getUpdateTime())
            ->setIsVisible($demoModel->getIsVisible())
            ->setIsActive($demoModel->getIsActive());
        return $demoDataObject;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($searchCriteria);

        /** @var Collection $collection */
        $collection = $this->demoFactory->create()->getCollection();
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $searchCriteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($searchCriteria->getCurrentPage());
        $collection->setPageSize($searchCriteria->getPageSize());
        /** @var DemoInterface[] $demos */
        $demos = [];
        /** @var Demo $demo */
        foreach ($collection as $demo) {
            /** @var DemoInterface $demoDataObject */
            $demoDataObject = $this->demoDataFactory->create()
                ->setId($demo->getId())
                ->setTitle($demo->getTitle())
                ->setCreationTime($demo->getCreationTime())
                ->setUpdateTime($demo->getUpdateTime())
                ->setIsVisible($demo->getIsVisible())
                ->setIsActive($demo->getIsActive());

            $demos[] = $demoDataObject;
        }
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults->setItems($demos);
    }

    /**
     * Delete demo list item.
     *
     * @param DemoInterface $demo
     * @return bool true on success
     * @throws \Magento\Framework\Exception\StateException If customer group cannot be deleted
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(DemoInterface $demo)
    {
        return $this->deleteById($demo->getId());
    }

    /**
     * Delete demo list item by ID.
     *
     * @param int $id
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\StateException If customer group cannot be deleted
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id)
    {
        $demoModel = $this->demoRegistry->retrieve($id);

        if ($id <= 0) {
            throw new \Magento\Framework\Exception\StateException(__('Cannot delete demo item.'));
        }

        $demoModel->delete();
        $this->demoRegistry->remove($id);
        return true;
    }


}