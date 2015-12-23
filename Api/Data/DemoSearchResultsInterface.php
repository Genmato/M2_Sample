<?php
/**
 * Sample
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-12-23
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Api\Data;

use Genmato\Sample\Api\Data\DemoInterface;
use Magento\Framework\Api\SearchResultsInterface;

interface DemoSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get demo item list.
     *
     * @api
     * @return DemoInterface[]
     */
    public function getItems();

    /**
     * Set demo item list.
     *
     * @api
     * @param DemoInterface[] $items
     * @return $this
     */
    public function setItems(array $items);

}