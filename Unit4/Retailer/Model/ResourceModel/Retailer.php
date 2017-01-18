<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Unit4\Retailer\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\Context;

class Retailer extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    protected $regionFactory = null;

    public function __construct(
        Context $context,
        \Magento\Directory\Model\RegionFactory $regionFactory,
        $connectionName = null
    ) {
        parent::__construct($context, $connectionName);
        $this->regionFactory = $regionFactory;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('unit4_retailer', 'retailer_id');
    }

    public function getRegion($regionId) {
        return $this->regionFactory->create()
          ->load($regionId)
          ->getCode();
    }

    public function getAssociatedProductIds($retailerId) {
        $select = $this->getConnection()->select()
          ->from(['r2p' => 'unit4_retailer2product'])
          ->where('retailer_id=?', $retailerId);

        $rows = $this->getConnection()->fetchAll($select);
        $ids = [];
        foreach ($rows as $row) {
            $ids[] = $row['product_id'];
        }
        return $ids;
    }
}
