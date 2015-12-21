<?php
/**
 * Genmato_Sample
 *
 * @package Genmato_Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-12-21
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as EventObserver;
use \Genmato\Sample\Model\DemoFactory;

class PlaceOrder implements ObserverInterface
{
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
     * Add record to demoList when new order is placed
     *
     * @param EventObserver $observer
     * @return void
     */
    public function execute(EventObserver $observer)
    {
        /** @var \Magento\Sales\Model\Order $order */
        $order = $observer->getEvent()->getOrder();

        $demoList = $this->demoFactory->create();

        $demoList->setTitle(__('New order (%1) placed!', $order->getIncrementId()));

        try {
            $demoList->save();
        } catch (\Exception $ex) {
            // Process error here....
        }

    }
}