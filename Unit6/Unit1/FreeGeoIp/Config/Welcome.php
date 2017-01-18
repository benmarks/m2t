<?php

namespace Unit1\FreeGeoIp\Config;

class Welcome extends \Magento\Framework\Config\Data implements \Unit1\FreeGeoIp\Config\WelcomeInterface
{
    /**
     * @param \Unit1\FreeGeoIp\Config\Welcome\Reader $reader
     * @param \Magento\Framework\Config\CacheInterface $cache
     * @param string $cacheId
     */
    public function __construct(
        \Unit1\FreeGeoIp\Config\Welcome\Reader $reader,
        \Magento\Framework\Config\CacheInterface $cache,
        $cacheId = 'freegeoip_options_config'
    ) {
        parent::__construct($reader, $cache, $cacheId);
    }

    /**
     * Get configuration of the welcome message
     *
     * @param string $country
     * @param string $location
     * @return string
     */
    public function getWelcome($country, $location = null)
    {
        $data  = $this->getAll();
        $data  = $data['default'];
        $value = null;

        if (isset($data[$country])) {
            $countryConf = $data[$country];
            if ($location && isset($countryConf[$location])) {
                $value = $countryConf[$location];
            } else if (isset($countryConf['default'])) {
                $value = $countryConf['default'];
            }
        }
        
        if (!$value) {
            $value = $data['default'];
        }
        if (is_array($value)) {
            list($k, $v) = each ($value);
            $value = $v;
        }
        return $value;
    }

    /**
     * Get configuration of all registered welcome messages
     *
     * @return array
     */
    public function getAll()
    {
        return $this->get();
    }
}
