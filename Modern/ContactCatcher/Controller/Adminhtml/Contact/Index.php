<?php


namespace Modern\ContactCatcher\Controller\Adminhtml\Contact;
use Magento\Backend\App\Action;
use Modern\ContactCatcher\Controller\Adminhtml\Contact;

/**
 * Class Index
 * @package Modern\ContactCatcher\Controller\Adminhtml\Contact
 */
class Index extends Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
public $resultPageFactory;

    /**
     * Index constructor.
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Modern_ContactCatcher::all');
        $resultPage->getConfig()->getTitle()->prepend(__("Contact Us Grid"));
        return $resultPage;
    }
}

