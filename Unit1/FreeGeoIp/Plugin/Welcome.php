<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit1\FreeGeoIp\Plugin;

class Welcome
{
    /**
     * @var registry
     */
    protected $registry;

    /**
     * @var config
     */
    protected $config = null;

    /**
     * @param Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Framework\Registry $registry,
        \Unit1\FreeGeoIp\Config\WelcomeInterface $config
    ) {
        $this->registry = $registry;
        $this->config   = $config;
    }

    /**
     * @param Action $subject
     * @param Action $result
     * @return Action
     *
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterGetWelcome(
        \Magento\Theme\Block\Html\Header $subject,
        $result
    ) {
        $countryCode = $this->registry->registry('country_code');
        $location    = $this->registry->registry('location');
        $welcomeMessage = $this->config->getWelcome($countryCode, $location);
        return  __($welcomeMessage);
    }
}
