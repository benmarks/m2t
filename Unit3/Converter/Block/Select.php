<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Unit3\Converter\Block;

class Select extends \Magento\Framework\View\Element\Template
{

    protected $urlBuilder;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $data);
    }

    public function getFormAction() {
        return $this->urlBuilder->getUrl('*/post', []);
    }

    public function getCurrencies() {
        return ['USD', 'GBP', 'EUR', 'UAH'];
    }

}


