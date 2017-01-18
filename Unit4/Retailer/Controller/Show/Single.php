<?php

namespace Unit4\Retailer\Controller\Show;

class Single extends \Magento\Framework\App\Action\Action
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

        $retailer = $this->retailerFactory->create()
          ->load($retailerId);
        
        $data = [
            'name'       => $retailer->getName(), 
            'country_id' => $retailer->getCountryId(),
            'region'     => $retailer->getRegion(),
            'products'   => $retailer->getAssociatedProductIds()
        ];
        return $this->jsonResult->setData($data);
    }
}