<?php
/**
 * 
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-11-12
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Setup;

use Genmato\Sample\Model\Demo;
use Genmato\Sample\Model\DemoFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    /**
     * Demo factory
     *
     * @var DemoFactory
     */
    private $demoFactory;

    /**
     * Init
     *
     * @param DemoFactory $demoFactory
     */
    public function __construct(DemoFactory $demoFactory)
    {
        $this->demoFactory = $demoFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $demoData = [
                'title' => 'Demo Title',
                'is_active' => 1,
        ];

        /**
         * Insert demo data
         */
        $this->createDemo()->setData($demoData)->save();

    }

    /**
     * Create demo
     *
     * @return Demo
     */
    public function createDemo()
    {
        return $this->demoFactory->create();
    }
} 
