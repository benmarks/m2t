<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit5\RetailerApi\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for retailer search results.
 * @api
 */
interface RetailerSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get retailers list.
     *
     * @return \Unit5\RetailerApi\Api\Data\RetailerInterface[]
     */
    public function getItems();

    /**
     * Set retailers list.
     *
     * @param \Unit5\RetailerApi\Api\Data\RetailerInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
