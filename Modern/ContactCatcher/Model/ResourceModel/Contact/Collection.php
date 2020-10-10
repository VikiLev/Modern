<?php

namespace Modern\ContactCatcher\Model\ResourceModel\Contact;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package Modern\ContactCatcher\Model\ResourceModel\Contact
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(\Modern\ContactCatcher\Model\Contact::class, \Modern\ContactCatcher\Model\ResourceModel\Contact::class);
    }
}
