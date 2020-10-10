<?php

namespace Modern\ContactCatcher\Model\ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Contact
 * @package Modern\ContactCatcher\Model\ResourceModel
 */
class Contact extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('contactUs', 'entity_id');
    }
}
