<?php
/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit2\Converter\Controller\Display;

class Rates extends \Magento\Framework\App\Action\Action
{

    const CONVERTER_URL_PATTERN = 'https://www.google.com/finance/converter?a=%s&from=%s&to=%s';

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJson;

    protected $client;
    
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Magento\Framework\HTTP\ClientFactory $clientFactory
    ) {
        parent::__construct($context);
        $this->client = $clientFactory->create();
        $this->resultJson = $jsonFactory->create();
    }

    public function execute()
    {
        $from = $this->getRequest()->getParam('from', 'USD');
        $to   = $this->getRequest()->getParam('to', 'EUR');
        $amount = $this->getRequest()->getParam('amount', 0);

        $result = ['error' => ''];
        $url = sprintf(self::CONVERTER_URL_PATTERN, $amount, $from, $to);

        try {
            $this->client->get($url);
            $response = $this->client->getBody();
            if (preg_match("%<span class=bld>(\d+\.\d+).*?</span>%", $response, $m)){
                $value = $m[1];
                $result = ['amount' => $amount, 'from' => $from, 'to' => $to, 'result' => $value];
            } else {
                $result['error'] = 'Wrong request';
            }
        } catch (Exception $e) {
            $result['error'] = $e->getMessage();
        }
        
        return $this->resultJson->setData($result);
    }
}
