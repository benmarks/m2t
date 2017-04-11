<?php

/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit3\Converter\Controller\Display;

class Result extends \Magento\Framework\App\Action\Action
{

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $pageFactory;
    
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\HTTP\ClientFactory $clientFactory
    ) {
        parent::__construct($context);
        $this->pageFactory = $pageFactory;
    }

    public function execute()
    {

        $from   = $this->getRequest()->getParam('from', 'USD');
        $to     = $this->getRequest()->getParam('to', 'EUR');
        $amount = $this->getRequest()->getParam('amount', 0);
        $result = $this->getRequest()->getParam('result', 0);

        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->set(__("Converter"));
        
        $page->getLayout()->getBlock('converter.result')
          ->setFromCurrency($from)
          ->setToCurrency($to)
          ->setAmount($amount)
          ->setResultAmount($result);

        return $page;
    }
}
