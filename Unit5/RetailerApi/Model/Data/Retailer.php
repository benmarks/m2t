<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Unit5\RetailerApi\Model\Data;

/**
 * Class Retailer
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 */
class Retailer extends \Magento\Framework\Api\AbstractExtensibleObject implements
    \Unit5\RetailerApi\Api\Data\RetailerInterface
{

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId() {
        return $this->_get(self::RETAILER_ID);
    }

    /**
     * Get identifier
     *
     * @return string
     */
    public function getName() {
        return $this->_get(self::NAME);
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getCountryId() {
        return $this->_get(self::COUNTRY_ID);
    }

    /**
     * Get content
     *
     * @return int
     */
    public function getRegionId() {
        return $this->_get(self::REGION_ID);
    }

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreatedAt() {
        return $this->_get(self::CREATED_AT);    
    }

    /**
     * Get city
     *
     * @return string|null
     */
    public function getCity() {
        return $this->_get(self::CITY);
    }


    /**
     * Get street
     *
     * @return string|null
     */
    public function getStreet() {
        return $this->_get(self::STREET);
    }

    /**
     * Get postcode
     *
     * @return string|null
     */
    public function getPostcode() {
        return $this->_get(self::POSTCODE);
    }


    /**
     * Set ID
     *
     * @param int $id
     * @return RetailerInterface
     */
    public function setId($id) {
        return $this->setData(self::RETAILER_ID, $id);
    }

    /**
     * Set name
     *
     * @param string $name
     * @return RetailerInterface
     */
    public function setName($name) {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set country_id
     *
     * @param string $title
     * @return RetailerInterface
     */
    public function setCountryId($countryId) {
        return $this->setData(self::COUNTRY_ID, $countryId);
    }

    /**
     * Set region_id
     *
     * @param int $regionId
     * @return RetailerInterface
     */
    public function setRegionId($regionId) {
        return $this->setData(self::REGION_ID, $regionId);
    }

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return RetailerInterface
     */
    public function setCreatedAt($creationTime) {
        return $this->setData(self::CREATED_AT, $creationTime);
    }


    /**
     * Set city
     *
     * @param string $city
     * @return RetailerInterface
     */
    public function setCity($city) {
        return $this->setData(self::CITY, $city);
    }


    /**
     * Set street
     *
     * @param string $street
     * @return RetailerInterface
     */
    public function setStreet($street) {
        return $this->setData(self::STREET, $street);
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     * @return RetailerInterface
     */
    public function setPostcode($postcode) {
        return $this->setData(self::POSTCODE, $postcode);
    }
}
