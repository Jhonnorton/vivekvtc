<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsletterSubscribers
 *
 * @ORM\Table(name="newsletter_subscribers")
 * @ORM\Entity
 */
class NewsletterSubscribers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_regular_client", type="integer", nullable=true)
     */
    private $isRegularClient;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="member_id", type="integer", nullable=false)
     */
    private $memberId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_mail_date", type="datetime", nullable=true)
     */
    private $lastMailDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_updated", type="datetime", nullable=true)
     */
    private $lastUpdated;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return NewsletterSubscribers
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return NewsletterSubscribers
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set isRegularClient
     *
     * @param integer $isRegularClient
     * @return NewsletterSubscribers
     */
    public function setIsRegularClient($isRegularClient)
    {
        $this->isRegularClient = $isRegularClient;

        return $this;
    }

    /**
     * Get isRegularClient
     *
     * @return integer 
     */
    public function getIsRegularClient()
    {
        return $this->isRegularClient;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return NewsletterSubscribers
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set memberId
     *
     * @param integer $memberId
     * @return NewsletterSubscribers
     */
    public function setMemberId($memberId)
    {
        $this->memberId = $memberId;

        return $this;
    }

    /**
     * Get memberId
     *
     * @return integer 
     */
    public function getMemberId()
    {
        return $this->memberId;
    }

    /**
     * Set lastMailDate
     *
     * @param \DateTime $lastMailDate
     * @return NewsletterSubscribers
     */
    public function setLastMailDate($lastMailDate)
    {
        $this->lastMailDate = $lastMailDate;

        return $this;
    }

    /**
     * Get lastMailDate
     *
     * @return \DateTime 
     */
    public function getLastMailDate()
    {
        return $this->lastMailDate;
    }

    /**
     * Set lastUpdated
     *
     * @param \DateTime $lastUpdated
     * @return NewsletterSubscribers
     */
    public function setLastUpdated($lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }

    /**
     * Get lastUpdated
     *
     * @return \DateTime 
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }
}
