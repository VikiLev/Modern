<?php

namespace Modern\ContactCatcher\Api\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Data\SearchResultInterface;
use Modern\ContactCatcher\Api\Model\Data\ContactInterface;

/**
 * Interface ContactRepositoryInterface
 * @package Modern\ContactCatcher\Api\Model
 */
Interface ContactRepositoryInterface
{
    /**
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * @param ContactInterface $contact
     * @return mixed
     */
    public function save(ContactInterface $contact);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return SearchResultInterface
     */

    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param ContactInterface $contact
     * @return mixed
     */
    public function delete(ContactInterface $contact);

    /**
     * @param int $id
     * @return mixed
     */
    public function deleteById(int $id);
}
