<?php
/**
 * Sample
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-12-22
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Api;

interface DemoRepositoryInterface
{
    /**
     * Save demo list item.
     *
     * @api
     * @param \Genmato\Sample\Api\Data\DemoInterface $demo
     * @return \Genmato\Sample\Api\Data\DemoInterface
     * @throws \Magento\Framework\Exception\InputException If there is a problem with the input
     * @throws \Magento\Framework\Exception\NoSuchEntityException If a group ID is sent but the group does not exist
     * @throws \Magento\Framework\Exception\State\InvalidTransitionException
     *      If saving customer group with customer group code that is used by an existing customer group
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Genmato\Sample\Api\Data\DemoInterface $demo);

    /**
     * Get demo list item by ID.
     *
     * @api
     * @param int $id
     * @return \Genmato\Sample\Api\Data\DemoInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException If $groupId is not found
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($id);

    /**
     * Retrieve demo list items.
     *
     * The list of demo items can be filtered
     *
     * @api
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Genmato\Sample\Api\Data\DemoSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete demo list item.
     *
     * @api
     * @param \Genmato\Sample\Api\Data\DemoInterface $demo
     * @return bool true on success
     * @throws \Magento\Framework\Exception\StateException If customer group cannot be deleted
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Genmato\Sample\Api\Data\DemoInterface $demo);

    /**
     * Delete demolist by ID.
     *
     * @api
     * @param int $id
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\StateException If customer group cannot be deleted
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($id);
}