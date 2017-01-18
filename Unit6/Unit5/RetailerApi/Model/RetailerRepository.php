<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit5\RetailerApi\Model;

use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Unit4\Retailer\Model\RetailerFactory as RetailerFactory;
use Unit5\RetailerApi\Model\Data\RetailerFactory as RetailerDataFactory;
use Unit5\RetailerApi\Api\Data\RetailerSearchResultsInterfaceFactory as SearchResults;

/**
 * Class RetailerRepository
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class RetailerRepository implements \Unit5\RetailerApi\Api\RetailerRepositoryInterface
{
    /**
     * @var RetailerDataFactory
     */
    protected $retailerDataFactory;

    /**
     * @var Retailer
     */
    protected $retailer;

    /**
     * @var Unit5\RetailerApi\Api\Data\RetailerSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;

    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;

    /**
     * @param Data\PageInterfaceFactory $dataPageFactory
     * @param RetailerFactory $retailerFactory
     * @param Data\PageSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     */
    public function __construct(
        RetailerFactory $retailerFactory,
        SearchResults $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        RetailerDataFactory $retailerDataFactory
    ) {
        $this->retailerFactory = $retailerFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->retailerDataFactory = $retailerDataFactory;
    }

    /**
     * Save Retailer data
     *
     * @param \Unit5\RetailerApi\Api\Data\RetailerInterface $retailer
     * @return Retailer
     */
    public function save(\Unit5\RetailerApi\Api\Data\RetailerInterface $retailer)
    {
        $retailerModel = $this->retailerFactory->create();
        if ($retailer->getId()){
            $retailerModel->load($retailer->getId());
        }
        $retailerModel->setName($retailer->getName())
          ->setCountryId($retailer->getCountryId())
          ->setRegionId($retailer->getRegionId())
          ->setCity($retailer->getCity())
          ->setStreet($retailer->getStreet())
          ->setPostcode($retailer->getPostcode())
          ->save();

        $retailer->setId($retailerModel->getId());
        return $retailer;
    }

    /**
     * Load Page data by given Page Identity
     *
     * @param string $pageId
     * @return Page
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($retailerId)
    {
        $retailer = $this->retailerFactory->create()->load($retailerId);
        if (!$retailer->getId()) {
            throw new NoSuchEntityException(__('Retailer with id "%1" does not exist.', $retailerId));
        }

        $data = $this->retailerDataFactory->create();
        $this->dataObjectHelper->populateWithArray(
            $data,
            $retailer->getData(),
            'Unit5\RetailerApi\Api\Data\RetailerInterface'
        );
        $data->setId($retailer->getRetailerId());

        return $data;
    }

    /**
     * Load Retailer data collection by given search criteria
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Unit5\RetailerApi\Api\Data\RetailerSearchResultInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $criteria)
    {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);

        $collection = $this->retailerFactory->create()->getCollection();
        
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $retailers = [];
        /** @var Retailer $retailerModel */
        foreach ($collection as $retailerModel) {
            $retailerData = $this->retailerDataFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $retailerData,
                $retailerModel->getData(),
                'Unit5\RetailerApi\Api\Data\RetailerInterface'
            );
            $retailers[] = $this->dataObjectProcessor->buildOutputDataArray(
                $retailerData,
                'Unit5\RetailerApi\Api\Data\RetailerInterface'
            );
        }
        $searchResults->setItems($retailers);
        return $searchResults;
    }


    /**
     * Delete Retailer by given Retailer ID
     *
     * @param string $retailerId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($retailerId)
    {
        if($this->retailerFactory->create()->load($retailerId)->delete()) {
            return true;
        }
        return false;
    }
}
