<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Unit4\Retailer\Setup;

use Magento\Cms\Model\Page;
use Magento\Cms\Model\PageFactory;
use Magento\Framework\Module\Setup\Migration;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallData implements InstallDataInterface
{

    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $retailers = [
            ['name' => 'First Retailer',  'country_id' => 'US', 'region_id' => 12, 'city' => 'Los Angeles', 'street' => '20124 Sepulveda Blvd.', 'postcode' => '91234'],
            ['name' => 'Second Retailer', 'country_id' => 'US', 'region_id' => 43, 'city' => 'New York',  'street' => '8234 Some str.', 'postcode' => '23341'],
            ['name' => 'Third Retailer', 'country_id' => 'CA', 'region_id' => 76, 'city' => 'Quebec',  'street' => '5454 Other str.', 'postcode' => '43213'],
            ['name' => 'Third Retailer', 'country_id' => 'CA', 'region_id' => 74, 'city' => 'Toronto',  'street' => '12121 Canada str.', 'postcode' => '112213']
        ];

        foreach ($retailers as $bind) {
            $setup->getConnection()
                ->insertForce($setup->getTable('unit4_retailer'), $bind);
        }
    }

}
