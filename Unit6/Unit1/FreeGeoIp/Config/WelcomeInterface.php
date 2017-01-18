<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit1\FreeGeoIp\Config;

interface WelcomeInterface
{
    /**
     * Get configuration of the welcome message
     *
     * @param string $country
     * @param string $location
     * @return string
     */
    public function getWelcome($country, $location = null);

    /**
     * Get configuration of all registered welcome messages
     *
     * @return array
     */
    public function getAll();
}
