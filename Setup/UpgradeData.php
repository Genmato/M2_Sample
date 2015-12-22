<?php
/**
 * Sample
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-12-22
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Catalog\Model\Product;

/**
 * @codeCoverageIgnore
 */
class UpgradeData implements UpgradeDataInterface
{
    /**
     * EAV setup factory
     *
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * Init
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '0.8.4', '<')) {
            /** @var EavSetup $eavSetup */
            $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

            $fieldList = [
                'price',
                'special_price',
                'special_from_date',
                'special_to_date',
                'minimal_price',
                'cost',
                'tier_price',
                'weight',
            ];

            // make these attributes applicable to demo product
            foreach ($fieldList as $field) {
                $applyTo = explode(
                    ',',
                    $eavSetup->getAttribute(Product::ENTITY, $field, 'apply_to')
                );
                if (!in_array('demo', $applyTo)) {
                    $applyTo[] = 'demo';
                    $eavSetup->updateAttribute(
                        Product::ENTITY,
                        $field,
                        'apply_to',
                        implode(',', $applyTo)
                    );
                }
            }
        }
    }
}
