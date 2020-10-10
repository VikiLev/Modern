<?php


namespace Modern\ContactCatcher\Controller\Adminhtml\Contact;
use Magento\Backend\App\Action;
use Modern\ContactCatcher\Controller\Adminhtml\Contact;

class Index extends Action
{

public $resultPageFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }


    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Modern_ContactCatcher::all');
        $resultPage->getConfig()->getTitle()->prepend(__("Contact Us Grid"));
        return $resultPage;
    }
}

