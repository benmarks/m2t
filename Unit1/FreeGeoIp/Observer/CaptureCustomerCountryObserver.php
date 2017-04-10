<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit1\FreeGeoIp\Observer;

use Magento\Framework\Event\ObserverInterface;

/**
 * Capture Customer Country
 *
 */
class CaptureCustomerCountryObserver implements ObserverInterface
{

    const FREEGEOIP_URL = 'http://freegeoip.net/json/';

    protected $registry   = null;
    protected $client     = null;
    protected $remoteAddr = null;
    protected $decoder    = null;

    /**
     * @param Item $item
     */
    public function __construct(
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\HTTP\ClientFactory $clientFactory,
        \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $remoteAddr,
        \Magento\Framework\Json\DecoderInterface $decoder
    ) {
        $this->registry   = $coreRegistry;
        $this->client     = $clientFactory->create();
        $this->remoteAddr = $remoteAddr;
        $this->decoder    = $decoder;
    }

    /**
     * Customer login bind process
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     *
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->registry->registry('country_code'))
            return; 

        $info = array();
        try {
            $this->client->get($this->getFreeGeoIpRequestUri());
            $jsonInfo = $this->client->getBody();
            $info = $this->decoder->decode($jsonInfo);
        } catch (Exception $e) {

        }
        $countryCode = isset($info['country_code']) && $info['country_code'] ? $info['country_code'] : 'default';
        $regionCode  = isset($info['region_code']) && $info['region_code'] ? $info['region_code'] : false;
        $city        = isset($info['city']) && $info['city'] ? $info['city'] : false;
        $location    = $regionCode ? $regionCode : $city;

        $this->registry->register('country_code', strtolower($countryCode));
        $this->registry->register('location', strtolower($location));
    }

    protected function getFreeGeoIpRequestUri() {
        return self::FREEGEOIP_URL . $this->remoteAddr->getRemoteAddress();
    }
}
