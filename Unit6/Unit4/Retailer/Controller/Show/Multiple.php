<?php

namespace Unit4\Retailer\Controller\Show;

class Multiple extends \Magento\Framework\App\Action\Action
{
    protected $jsonResult = null;

    protected $retailerFactory = null;

    public function __construct(
        \Magento\Framework\App\Action\Context $context, 
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Unit4\Retailer\Model\RetailerFactory $factory
    ) {
        parent::__construct($context);
        $this->jsonResult = $jsonFactory->create();
        $this->retailerFactory = $factory;
    }

    public function execute() {

        $retailerId = $this->getRequest()->getParam('retailer_id', 1);

        $collection = $this->retailerFactory->create()
          ->getCollection()
          ->addFilterByProduct(1);
        
        $data = [];

        foreach ($collection as $retailer) {
            $data[] = ['id' => $retailer->getId(), 'name' => $retailer->getName()];
        }
        return $this->jsonResult->setData($data);
    }
}