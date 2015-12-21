<?php
/**
 * Demo database add column
 *
 * @package Genmato_Sample
 * @author  Vladimir Kerkhoff <support@genmato.com>
 * @created 2015-11-12
 * @copyright Copyright (c) 2015 Genmato BV, https://genmato.com.
 */
namespace Genmato\Sample\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.1.1', '<')) {
            $connection = $setup->getConnection();

            $column = [
                'type' => Table::TYPE_SMALLINT,
                'length' => 6,
                'nullable' => false,
                'comment' => 'Is Visible',
                'default' => '1'
            ];
            $connection->addColumn($setup->getTable('genmato_demo'), 'is_visible', $column);
        }

        $setup->endSetup();
    }
}
