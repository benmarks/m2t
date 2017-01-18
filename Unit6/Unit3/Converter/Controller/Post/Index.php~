<?php
/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit3\Converter\Controller\Post;

class Index extends \Magento\Framework\App\Action\Action
{

    const CONVERTER_URL_PATTERN = 'https://www.google.com/finance/converter?a=%s&from=%s&to=%s';

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $pageFactory;

    /**
     * @var \Magento\Framework\HTTP\ClientInterface
     */
    protected $client;
    
    /**
     * @var \Magento\Framework\Data\Form\FormKey\Validator
     */
    protected $formKeyValidator;
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageFactory,
        \Magento\Framework\HTTP\ClientFactory $clientFactory,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator
    ) {
        parent::__construct($context);
        $this->client = $clientFactory->create();
        $this->pageFactory = $pageFactory;
        $this->formKeyValidator = $formKeyValidator;
    }

    public function execute()
    {
        if (!$this->formKeyValidator->validate($this->getRequest())) {
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('*/display/error');
            return $resultRedirect;
        }
        $from = $this->getRequest()->getParam('from', 'USD');
        $to   = $this->getRequest()->getParam('to', 'EUR');
        $amount = $this->getRequest()->getParam('amount', 0);

        $result = ['error' => ''];
        $url = sprintf(self::CONVERTER_URL_PATTERN, $amount, $from, $to);

        try {
            $this->client->get($url);
            $response = $this->client->getBody();
            if (preg_match("%<span class=.*bld.*>(\d+\.\d+).*?</span>%", $response, $m)){
                $value = $m[1];
                $result = ['amount' => $amount, 'from' => $from, 'to' => $to, 'result' => $value];
            }
            else if (preg_match("%<span class=.*bld.*>(\d+).*?</span>%", $response, $m)){
                $value = $m[1];
                $result = ['amount' => $amount, 'from' => $from, 'to' => $to, 'result' => $value];
            } else {
                $result['error'] = 'Wrong request';
            }
        } catch (Exception $e) {
            $result['error'] = $e->getMessage();
        }
        
        $resultRedirect = $this->resultRedirectFactory->create();
        if (isset($result['error'])) {
            $resultRedirect->setPath('*/display/error');
        } else {
            $resultRedirect->setPath('*/display/result', $result);
        }
        return $resultRedirect;
    }
}
