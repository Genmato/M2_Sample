<?php
/**
 * Sample
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-12-23
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Model;

use Genmato\Sample\Api\Data\DemoInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class DemoRegistry
{
    /**
     * @var array
     */
    protected $registry = [];

    /**
     * @var DemoFactory
     */
    protected $demoFactory;

    /**
     * @param DemoFactory $demoFactory
     */
    public function __construct(DemoFactory $demoFactory)
    {
        $this->demoFactory = $demoFactory;
    }

    /**
     * Get instance of the Demo Model identified by an id
     *
     * @param int $demoId
     * @return Demo
     * @throws NoSuchEntityException
     */
    public function retrieve($demoId)
    {
        if (isset($this->registry[$demoId])) {
            return $this->registry[$demoId];
        }
        $demo = $this->demoFactory->create();
        $demo->load($demoId);
        if ($demo->getId() === null || $demo->getId() != $demoId) {
            throw NoSuchEntityException::singleField(DemoInterface::ID, $demoId);
        }
        $this->registry[$demoId] = $demo;
        return $demo;
    }

    /**
     * Remove an instance of the Demo Model from the registry
     *
     * @param int $demoId
     * @return void
     */
    public function remove($demoId)
    {
        unset($this->registry[$demoId]);
    }
}