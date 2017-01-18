<?php
/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit2\OrderInfo\Controller\Info;

class Index extends \Magento\Framework\App\Action\Action
{

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $resultJson;

    /**
     * @var \Magento\Sales\Api\OrderRepositoryInterface
     */
    protected $orderRepository;
    
    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
     * @param \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
     */

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Magento\Sales\Api\OrderRepositoryInterface $orderRepository
    ) {
        parent::__construct($context);
        $this->resultJson = $jsonFactory->create();
        $this->orderRepository = $orderRepository;
    }

    public function execute()
    {
        $orderId = $this->getRequest()->getParam('order_id');

        $order = $this->orderRepository->get($orderId);
        
        $data = [
            'status' => $order->getStatus(),
            'total'  => $order->getGrandTotal(),
            'total_invoiced' => $order->getTotalInvoiced(),
            'items' => []
        ];
        foreach ($order->getAllItems() as $item) {
            $data['items'][] = [
                'item_id' => $item->getId(),
                'sku'     => $item->getSku(),
                'name'    => $item->getName(),
                'price'   => $item->getPrice(),
                'total'   => $item->getRowTotal(),
                'qty'     => $item->getQtyOrdered()
            ];
        }
        return $this->resultJson->setData($data);
    }
}
