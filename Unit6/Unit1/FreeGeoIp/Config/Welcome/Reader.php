<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit1\FreeGeoIp\Config\Welcome;

class Reader extends \Magento\Framework\Config\Reader\Filesystem
{

    /**
     * @param \Magento\Framework\Config\FileResolverInterface $fileResolver
     * @param \Unit1\FreeGeoIp\Config\Welcome\Converter $converter
     * @param \Unit1\FreeGeoIp\Config\Welcome\SchemaLocator $schemaLocator
     * @param \Magento\Framework\Config\ValidationStateInterface $validationState
     * @param string $fileName
     * @param array $idAttributes
     * @param string $domDocumentClass
     * @param string $defaultScope
     */
    public function __construct(
        \Magento\Framework\Config\FileResolverInterface $fileResolver,
        \Unit1\FreeGeoIp\Config\Welcome\Converter $converter,
        \Unit1\FreeGeoIp\Config\Welcome\SchemaLocator $schemaLocator,
        \Magento\Framework\Config\ValidationStateInterface $validationState,
        $fileName = 'welcome.xml',
        $idAttributes = [],
        $domDocumentClass = 'Magento\Framework\Config\Dom',
        $defaultScope = 'global'
    ) {
        parent::__construct(
            $fileResolver,
            $converter,
            $schemaLocator,
            $validationState,
            $fileName,
            $idAttributes,
            $domDocumentClass,
            $defaultScope
        );
    }
}
