<?php
/**
 *
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Unit6\Retailer\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Unit6_Retailer::retailer';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Retailer::retailer');
        $resultPage->addBreadcrumb(__('Retailer'), __('Retailer'));
        $resultPage->addBreadcrumb(__('Manage Retailers'), __('Manage Retailers'));
        $resultPage->getConfig()->getTitle()->prepend(__('Retailers'));

        return $resultPage;
    }
}
