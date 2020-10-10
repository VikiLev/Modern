<?php

namespace Modern\ContactCatcher\Model;

use Magento\Framework\Data\Collection\AbstractDb;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\Context;
use Magento\Framework\Model\ResourceModel\AbstractResource;
use Magento\Framework\Registry;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Modern\ContactCatcher\Api\Model\Data\ContactInterface;

/**
 * Class Contact
 * @package Modern\ContactCatcher\Model
 */
class Contact extends AbstractModel implements ContactInterface
{

    const TABLE_NAME = 'contactUs';
    const ID_COL_NAME = 'entity_id';
    const NAME_COL_NAME = 'name';
    const PHONE_COL_NAME = 'phone';
    const EMAIL_COL_NAME = 'email';
    const TOPIC_COL_NAME = 'topic';
    const COMMENT_COL_NAME = 'comment';
    const CREATED_AT_COL_NAME = 'created_at';


    /**
     * @var TimezoneInterface
     */
    private $timezone;

    /**
     * Contact constructor.
     * @param Context $context
     * @param Registry $registry
     * @param TimezoneInterface $timezone
     * @param AbstractResource|null $resource
     * @param AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        TimezoneInterface $timezone,
        AbstractResource $resource = null,
        AbstractDb $resourceCollection = null,
        array $data = []
    )
    {
        $this->timezone = $timezone;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    public function _construct()
    {
        $this->_init(\Modern\ContactCatcher\Model\ResourceModel\Contact::class);
    }

    /**
     * @param string $name
     * @return $this|ContactInterface
     */
    public function setName(string $name): ContactInterface
    {
        $this->setData(self::NAME_COL_NAME, $name);

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getData(self::NAME_COL_NAME);
    }

    /**
     * @param string $phone
     * @return $this|ContactInterface
     */
    public function setPhone(string $phone): ContactInterface
    {
        $this->setData(self::PHONE_COL_NAME, $phone);

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->getData(self::PHONE_COL_NAME);
    }

    /**
     * @param string $email
     * @return $this|ContactInterface
     */
    public function setEmail(string $email): ContactInterface
    {
        $this->setData(self::EMAIL_COL_NAME, $email);

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->getData(self::EMAIL_COL_NAME);
    }

    /**
     * @param string $topic
     * @return $this|ContactInterface
     */
    public function setTopic(string $topic): ContactInterface
    {
        $this->setData(self::TOPIC_COL_NAME, $topic);

        return $this;
    }

    /**
     * @return string
     */
    public function getTopic(): string
    {
        return $this->getData(self::TOPIC_COL_NAME);
    }

    /**
     * @param string $comment
     * @return $this|ContactInterface
     */
    public function setComment(string $comment): ContactInterface
    {
        $this->setData(self::COMMENT_COL_NAME, $comment);

        return $this;
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->getData(self::COMMENT_COL_NAME);
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        $timestamp = $this->getData(self::CREATED_AT_COL_NAME);

        return $this->timezone->date($timestamp);
    }
}
