<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit4\Retailer\Model;

class Retailer extends \Magento\Framework\Model\AbstractModel
{

    protected $region = null;

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Unit4\Retailer\Model\ResourceModel\Retailer');
    }

    public function getRegion() {
        if (!$this->region) {
            $this->region = $this->_getResource()->getRegion($this->getRegionId());
        }
        return $this->region;
    }

    public function getAssociatedProductIds() {
        return $this->_getResource()->getAssociatedProductIds($this->getId());
    }

}
