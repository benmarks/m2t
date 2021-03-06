<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit5\RetailerApi\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Retailer CRUD interface.
 * @api
 */
interface RetailerRepositoryInterface
{
    /**
     * Save retailer.
     *
     * @param \Unit5\RetailerApi\Api\Data\RetailerInterface $retailer
     * @return \Unit5\RetailerApi\Api\Data\RetailerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(Data\RetailerInterface $retailer);

    /**
     * Retrieve retailer.
     *
     * @param int $retailerId
     * @return \Unit5\RetailerApi\Api\Data\RetailerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($retailerId);

    /**
     * Retrieve retailers matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Unit5\RetailerApi\Api\Data\RetailerSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete retailer by ID.
     *
     * @param int $retailerId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($retailerId);
}
