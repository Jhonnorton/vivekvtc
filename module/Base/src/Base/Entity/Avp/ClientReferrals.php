<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClientReferrals
 *
 * @ORM\Table(name="client_referrals")
 * @ORM\Entity
 */
class ClientReferrals
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
     * @var integer
     *
     * @ORM\Column(name="client_id", type="integer", nullable=false)
     */
    private $clientId;

    /**
     * @var integer
     *
     * @ORM\Column(name="event_id", type="integer", nullable=true)
     */
    private $eventId;

    /**
     * @var integer
     *
     * @ORM\Column(name="resort_id", type="integer", nullable=true)
     */
    private $resortId;

    /**
     * @var integer
     *
     * @ORM\Column(name="cruise_id", type="integer", nullable=true)
     */
    private $cruiseId;

    /**
     * @var string
     *
     * @ORM\Column(name="friend_name", type="string", length=255, nullable=true)
     */
    private $friendName;

    /**
     * @var string
     *
     * @ORM\Column(name="friend_email", type="string", length=255, nullable=true)
     */
    private $friendEmail;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="referral_key", type="string", length=100, nullable=false)
     */
    private $referralKey;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime", nullable=true)
     */
    private $dateAdded;



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
     * Set clientId
     *
     * @param integer $clientId
     * @return ClientReferrals
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get clientId
     *
     * @return integer 
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set eventId
     *
     * @param integer $eventId
     * @return ClientReferrals
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return integer 
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Set resortId
     *
     * @param integer $resortId
     * @return ClientReferrals
     */
    public function setResortId($resortId)
    {
        $this->resortId = $resortId;

        return $this;
    }

    /**
     * Get resortId
     *
     * @return integer 
     */
    public function getResortId()
    {
        return $this->resortId;
    }

    /**
     * Set cruiseId
     *
     * @param integer $cruiseId
     * @return ClientReferrals
     */
    public function setCruiseId($cruiseId)
    {
        $this->cruiseId = $cruiseId;

        return $this;
    }

    /**
     * Get cruiseId
     *
     * @return integer 
     */
    public function getCruiseId()
    {
        return $this->cruiseId;
    }

    /**
     * Set friendName
     *
     * @param string $friendName
     * @return ClientReferrals
     */
    public function setFriendName($friendName)
    {
        $this->friendName = $friendName;

        return $this;
    }

    /**
     * Get friendName
     *
     * @return string 
     */
    public function getFriendName()
    {
        return $this->friendName;
    }

    /**
     * Set friendEmail
     *
     * @param string $friendEmail
     * @return ClientReferrals
     */
    public function setFriendEmail($friendEmail)
    {
        $this->friendEmail = $friendEmail;

        return $this;
    }

    /**
     * Get friendEmail
     *
     * @return string 
     */
    public function getFriendEmail()
    {
        return $this->friendEmail;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return ClientReferrals
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
     * Set referralKey
     *
     * @param string $referralKey
     * @return ClientReferrals
     */
    public function setReferralKey($referralKey)
    {
        $this->referralKey = $referralKey;

        return $this;
    }

    /**
     * Get referralKey
     *
     * @return string 
     */
    public function getReferralKey()
    {
        return $this->referralKey;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return ClientReferrals
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime 
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }
}
