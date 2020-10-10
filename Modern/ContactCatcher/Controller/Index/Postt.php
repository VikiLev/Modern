<?php

namespace Modern\ContactCatcher\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\View\Result\PageFactory;
use Psr\Log\LoggerInterface;
use Magento\Framework\Exception\LocalizedException;
use Modern\ContactCatcher\Model\ResourceModel\Contact\CollectionFactory;
use Modern\ContactCatcher\Model\ContactFactory;
use Modern\ContactCatcher\Api\Model\ContactRepositoryInterface;

/**
 * Class Postt
 * @package Modern\ContactCatcher\Controller\Index
 */
class Postt extends Action

{
    /**
     * @var CollectionFactory
     */
    public $collectionFactory;
    /**
     * @var ContactFactory
     */
    public $contactFactory;
    /**
     * @var LoggerInterface
     */
    public $logger;
    /**
     * @var ContactRepositoryInterface
     */
    public $repository;
    /**
     * @var PageFactory
     */
    public $pageFactory;

    /**
     * Save constructor.
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param ContactFactory $contactFactory
     * @param ContactRepositoryInterface $repository
     * @param LoggerInterface $logger
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        CollectionFactory $collectionFactory,
        ContactFactory $contactFactory,
        ContactRepositoryInterface $repository,
        LoggerInterface $logger)

    {
        $this->pageFactory = $pageFactory;
        $this->repository = $repository;
        $this->collectionFactory = $collectionFactory;
        $this->contactFactory = $contactFactory;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     * @throws \Zend_Validate_Exception
     */
    public function execute()
    {
        $params = $this->getRequest()->getParams();
        $model = $this->contactFactory->create();

        try {
            if (!\Zend_Validate::is(trim($params['name']), 'NotEmpty')) {
                throw new LocalizedException(('Enter the Name and try again.'));
            }
            if (!\Zend_Validate::is(trim($params['email']), 'EmailAddress') && !empty($params['email'])) {
                throw new LocalizedException(__('The email address is invalid. Verify the email address and try again.'));
            }

            $model->setName($params['name']);
            $model->setPhone($params['phone']);
            $model->setEmail($params['email']);
            $model->setTopic($params['topic']);
            $model->setComment($params['comment']);

            $this->repository->save($model);
            $this->messageManager->addSuccessMessage('Saved!');
        } catch (CouldNotSaveException $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addErrorMessage('Error');
        } catch (LocalizedException $e) {
            $this->logger->error($e->getMessage());
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        $this->_redirect('*/*/');
    }
}


