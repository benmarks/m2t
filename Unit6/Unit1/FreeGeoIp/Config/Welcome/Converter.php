<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit1\FreeGeoIp\Config\Welcome;

class Converter implements \Magento\Framework\Config\ConverterInterface
{
    /**
     * Convert dom node tree to array
     *
     * @param \DOMDocument $source
     * @return array
     * @throws \InvalidArgumentException
     */
    public function convert($source)
    {
        $output = [];
        /** @var $optionNode \DOMNode */
        foreach ($source->getElementsByTagName('welcome_message') as $node) {
            /** @var $childNode \DOMNode */
            foreach ($node->childNodes as $childNode) {
                if ($childNode->nodeType != XML_ELEMENT_NODE) {
                    continue;
                }
                $output[$childNode->nodeName] = $this->getCountryConfiguration($node);
            }
        }
        return $output;
    }

    protected function getCountryConfiguration($node) {
        $conf = [];
        foreach ($node->childNodes as $childNode) {
            if ($childNode->nodeType != XML_ELEMENT_NODE) {
                continue;
            }
            $locationConf = [];
            foreach ($childNode->childNodes as $location) {
                if ($childNode->nodeType != XML_ELEMENT_NODE) {
                    continue;
                }
                $locationConf[$location->nodeName] = $location->nodeValue;
            }
            $conf[$childNode->nodeName] = $locationConf;

        }
        return $conf;
    }

}
