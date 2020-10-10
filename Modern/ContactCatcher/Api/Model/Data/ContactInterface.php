<?php


namespace Modern\ContactCatcher\Api\Model\Data;


/**
 * Interface ContactInterface
 * @package Modern\ContactCatcher\Api\Model\Data
 */
interface ContactInterface
{
//    const CACHE_TAG                 = 'vika_quickorder';

//    const REGISTRY_KEY              = 'vika_quickorder_lesson';

    const ID_FIELD                  = 'entity_id';

    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param string $name
     * @return mixed
     */
    public function setName(string $name);

    /**
     * @return mixed
     */
    public function getName();

    /**
     * @param string $phone
     * @return mixed
     */
    public function setPhone(string $phone);

    /**
     * @return mixed
     */
    public function getPhone();

    /**
     * @param string $email
     * @return mixed
     */
    public function setEmail(string $email);

    /**
     * @return mixed
     */
    public function getEmail();

    /**
     * @param string $topic
     * @return mixed
     */
    public function setTopic(string $topic);

    /**
     * @return mixed
     */
    public function getTopic();

    /**
     * @param string $comment
     * @return mixed
     */
    public function setComment(string $comment);

    /**
     * @return mixed
     */
    public function getComment();

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt() : \DateTimeInterface;

}


