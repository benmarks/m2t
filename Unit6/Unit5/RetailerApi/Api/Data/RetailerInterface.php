<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit5\RetailerApi\Api\Data;

/**
 * Retailer interface.
 * @api
 */
interface RetailerInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const RETAILER_ID = 'retailer_id';
    const NAME        = 'name';
    const COUNTRY_ID  = 'country_id';
    const REGION_ID   = 'region_id';
    const CITY        = 'city';
    const STREET      = 'street';
    const POSTCODE    = 'postcode';
    const CREATED_AT  = 'created_at';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getName();

    /**
     * Get title
     *
     * @return string
     */
    public function getCountryId();

    /**
     * Get content
     *
     * @return int
     */
    public function getRegionId();

    /**
     * Get creation time
     *
     * @return string|null
     */
    public function getCreatedAt();


    /**
     * Get city
     *
     * @return string|null
     */
    public function getCity();

    /**
     * Get street
     *
     * @return string|null
     */
    public function getStreet();

    /**
     * Get postcode
     *
     * @return string|null
     */
    public function getPostcode();


    /**
     * Set ID
     *
     * @param int $id
     * @return RetailerInterface
     */
    public function setId($id);

    /**
     * Set name
     *
     * @param string $name
     * @return RetailerInterface
     */
    public function setName($name);

    /**
     * Set country_id
     *
     * @param string $title
     * @return RetailerInterface
     */
    public function setCountryId($countryId);

    /**
     * Set region_id
     *
     * @param int $regionId
     * @return RetailerInterface
     */
    public function setRegionId($regionId);

    /**
     * Set creation time
     *
     * @param string $creationTime
     * @return RetailerInterface
     */
    public function setCreatedAt($creationTime);


    /**
     * Set city
     *
     * @param string $city
     * @return RetailerInterface
     */
    public function setCity($city);

    /**
     * Set street
     *
     * @param string $street
     * @return RetailerInterface
     */
    public function setStreet($steet);

    /**
     * Set postcode
     *
     * @param string $postcode
     * @return RetailerInterface
     */
    public function setPostcode($postcode);
}
