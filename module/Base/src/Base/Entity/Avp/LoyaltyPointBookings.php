<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * LoyaltyPointBookings
 *
 * @ORM\Table(name="loyalty_point_bookings")
 * @ORM\Entity
 */
class LoyaltyPointBookings
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
     * @ORM\Column(name="order_id", type="integer", nullable=false)
     */
    private $orderId;

    /**
     * @var integer
     *
     * @ORM\Column(name="client_id", type="integer", nullable=true)
     */
    private $clientId;

    /**
     * @var integer
     *
     * @ORM\Column(name="points_used", type="integer", nullable=false)
     */
    private $pointsUsed;

    /**
     * @var integer
     *
     * @ORM\Column(name="mode", type="integer", nullable=false)
     */
    private $mode = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="string", length=255, nullable=true)
     */
    private $comments;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="date", nullable=true)
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
     * Set orderId
     *
     * @param integer $orderId
     * @return LoyaltyPointBookings
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
     * Set clientId
     *
     * @param integer $clientId
     * @return LoyaltyPointBookings
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
     * Set pointsUsed
     *
     * @param integer $pointsUsed
     * @return LoyaltyPointBookings
     */
    public function setPointsUsed($pointsUsed)
    {
        $this->pointsUsed = $pointsUsed;

        return $this;
    }

    /**
     * Get pointsUsed
     *
     * @return integer 
     */
    public function getPointsUsed()
    {
        return $this->pointsUsed;
    }

    /**
     * Set mode
     *
     * @param integer $mode
     * @return LoyaltyPointBookings
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
     * Set comments
     *
     * @param string $comments
     * @return LoyaltyPointBookings
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return LoyaltyPointBookings
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
