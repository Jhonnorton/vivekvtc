<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * LoyaltyPointsLogs
 *
 * @ORM\Table(name="loyalty_points_logs")
 * @ORM\Entity
 */
class LoyaltyPointsLogs
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
     * @ORM\Column(name="mode", type="integer", nullable=false)
     */
    private $mode;

    /**
     * @var integer
     *
     * @ORM\Column(name="client_referral_id", type="integer", nullable=true)
     */
    private $clientReferralId;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_id", type="integer", nullable=true)
     */
    private $orderId;

    /**
     * @var integer
     *
     * @ORM\Column(name="points_gain", type="integer", nullable=true)
     */
    private $pointsGain;

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
     * @return LoyaltyPointsLogs
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
     * Set mode
     *
     * @param integer $mode
     * @return LoyaltyPointsLogs
     */
    public function setMode($mode)
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * Get mode
     *
     * @return integer 
     */
    public function getMode()
    {
        return $this->mode;
    }

    /**
     * Set clientReferralId
     *
     * @param integer $clientReferralId
     * @return LoyaltyPointsLogs
     */
    public function setClientReferralId($clientReferralId)
    {
        $this->clientReferralId = $clientReferralId;

        return $this;
    }

    /**
     * Get clientReferralId
     *
     * @return integer 
     */
    public function getClientReferralId()
    {
        return $this->clientReferralId;
    }

    /**
     * Set orderId
     *
     * @param integer $orderId
     * @return LoyaltyPointsLogs
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set pointsGain
     *
     * @param integer $pointsGain
     * @return LoyaltyPointsLogs
     */
    public function setPointsGain($pointsGain)
    {
        $this->pointsGain = $pointsGain;

        return $this;
    }

    /**
     * Get pointsGain
     *
     * @return integer 
     */
    public function getPointsGain()
    {
        return $this->pointsGain;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return LoyaltyPointsLogs
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
