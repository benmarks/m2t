<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit4\Retailer\Setup;

use Magento\Cms\Model\Page;
use Magento\Cms\Model\PageFactory;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

class UpgradeData implements UpgradeDataInterface
{
    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '0.0.3', '<')) {
            $binds = [
                ['retailer_id' => 1,  'product_id' => 1],
                ['retailer_id' => 1,  'product_id' => 2],
                ['retailer_id' => 1,  'product_id' => 3],
                ['retailer_id' => 2,  'product_id' => 1],
                ['retailer_id' => 2,  'product_id' => 2],
                ['retailer_id' => 3,  'product_id' => 3],
                ['retailer_id' => 3,  'product_id' => 4],
                ['retailer_id' => 3,  'product_id' => 3],
                ['retailer_id' => 4,  'product_id' => 1]
            ];

        foreach ($binds as $bind) {
            $setup->getConnection()
                ->insertForce($setup->getTable('unit4_retailer2product'), $bind);
        }

        }
        $setup->endSetup();
    }
}
