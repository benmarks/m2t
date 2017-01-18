<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit4\Retailer\Model\ResourceModel\Retailer;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    protected function _construct()
    {
        $this->_init('Unit4\Retailer\Model\Retailer', 'Unit4\Retailer\Model\ResourceModel\Retailer');
    }

    public function addFilterByProduct($productId) {
        $productId = (int)$productId;

        $this->getSelect()
          ->join(
              ['r2p' => $this->getTable('unit4_retailer2product')], 
              "`main_table`.retailer_id=r2p.retailer_id AND `r2p`.product_id=$productId"
          );

        return $this;
    }

}
