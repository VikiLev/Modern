<?php


namespace Modern\ContactCatcher\Api\Model\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface ContactSearchResultsInterface
 * @package Modern\ContactCatcher\Api\Model\Data
 */
interface ContactSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \Magento\Framework\Api\ExtensibleDataInterface[]
     */
    public function getItems();

    /**
     * @param array $items
     * @return ContactSearchResultsInterface
     */
    public function setItems(array $items);
}
