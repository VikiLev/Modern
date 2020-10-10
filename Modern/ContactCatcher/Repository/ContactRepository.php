<?php

namespace Modern\ContactCatcher\Repository;
use Modern\ContactCatcher\Api\Model\ContactRepositoryInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Data\SearchResultInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Psr\Log\LoggerInterface;
use Modern\ContactCatcher\Model\ResourceModel\Contact as ResourceModel;
use Modern\ContactCatcher\Model\ResourceModel\Contact\CollectionFactory;
use Modern\ContactCatcher\Api\Model\Data\ContactInterface;
use Modern\ContactCatcher\Api\Model\Data\ContactInterfaceFactory;

/**
 * Class ContactRepository
 * @package Modern\ContactCatcher\Repository
 */
class ContactRepository implements ContactRepositoryInterface
{
    /**
     * @var LoggerInterface
     */
    public $logger;
    /**
     * @var ContactInterfaceFactory
     */
    public $modelFactory;
    /**
     * @var ResourceModel
     */
    public $resourceModel;
    /**
     * @var CollectionFactory
     */
    public $collectionFactory;
    /**
     * @var CollectionProcessorInterface
     */
    public $collectionProcessor;

    /**
     * ContactRepository constructor.
     * @param LoggerInterface $logger
     * @param ContactInterfaceFactory $contactInterfaceFactory
     * @param ResourceModel $resourceModel
     * @param CollectionFactory $collectionFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        LoggerInterface $logger,
        ContactInterfaceFactory $contactInterfaceFactory,
        ResourceModel $resourceModel,
        CollectionFactory $collectionFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->collectionProcessor = $collectionProcessor;
        $this->collectionFactory    = $collectionFactory;
        $this->resourceModel        = $resourceModel;
        $this->logger               = $logger;
        $this->modelFactory         = $contactInterfaceFactory;
    }

    /**
     * @param int $id
     * @return ContactInterface
     * @throws NoSuchEntityException
     */
    public function getById(int $id): ContactInterface
    {
        $model = $this->modelFactory->create();

        $this->resourceModel->load($model, $id);

        if (null === $model->getId()) {
            throw new NoSuchEntityException(__('Model with %1 not found', $id));
        }

        return $model;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): SearchResultInterface
    {
        $collection = $this->collectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResult = $this->searchResultFactory->create();

        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getData());

        return $searchResult;
    }

    /**
     * @param ContactInterface $contact
     * @return $this|ContactRepositoryInterface
     * @throws CouldNotSaveException
     */
    public function save(ContactInterface $contact): ContactRepositoryInterface
    {
        try {
            $this->resourceModel->save($contact);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotSaveException(__("QuickOrder not saved"));
        }

        return  $this;
    }

    /**
     * @param ContactInterface $contact
     * @return $this|ContactRepositoryInterface
     * @throws CouldNotDeleteException
     */
    public function delete(ContactInterface $contact): ContactRepositoryInterface
    {
        try {
            $this->resourceModel->delete($contact);
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            throw new CouldNotDeleteException(__("contact %1 not deleted", $contact->getId()));
        }
        return  $this;
    }

    /**
     * @param int $id
     * @return $this|ContactRepositoryInterface
     * @throws CouldNotDeleteException
     */
    public function deleteById(int $id): ContactRepositoryInterface
    {
        try {
            $model = $this->getById($id);
            $this->delete($model);
        } catch (NoSuchEntityException $e) {
            $this->logger->warning(sprintf("contact %d already deleted or not found", $id));
        }

        return $this;
    }
}
