<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity
 */
class Orders
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
     * @ORM\Column(name="event_id", type="integer", nullable=false)
     */
    private $eventId;

    /**
     * @var integer
     *
     * @ORM\Column(name="client_id", type="integer", nullable=false)
     */
    private $clientId;

    /**
     * @var integer
     *
     * @ORM\Column(name="affiliate_id", type="integer", nullable=true)
     */
    private $affiliateId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="resort_room_id", type="integer", nullable=false)
     */
    private $resortRoomId;

    /**
     * @var integer
     *
     * @ORM\Column(name="room_count", type="integer", nullable=true)
     */
    private $roomCount = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="travel_date_from", type="date", nullable=true)
     */
    private $travelDateFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="travel_date_to", type="date", nullable=true)
     */
    private $travelDateTo;

    /**
     * @var string
     *
     * @ORM\Column(name="currency", type="string", length=100, nullable=false)
     */
    private $currency;

    /**
     * @var integer
     *
     * @ORM\Column(name="coupon_id", type="integer", nullable=true)
     */
    private $couponId;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_total", type="float", precision=10, scale=0, nullable=true)
     */
    private $amountTotal;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_due", type="float", precision=10, scale=0, nullable=true)
     */
    private $amountDue;

    /**
     * @var float
     *
     * @ORM\Column(name="deposit_amount", type="float", precision=10, scale=0, nullable=true)
     */
    private $depositAmount;

    /**
     * @var integer
     *
     * @ORM\Column(name="special_id", type="integer", nullable=true)
     */
    private $specialId;

    /**
     * @var float
     *
     * @ORM\Column(name="preferred_discount", type="float", precision=10, scale=0, nullable=true)
     */
    private $preferredDiscount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="first_due_date", type="date", nullable=true)
     */
    private $firstDueDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="second_due_date", type="date", nullable=true)
     */
    private $secondDueDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="insurance", type="integer", nullable=false)
     */
    private $insurance;

    /**
     * @var integer
     *
     * @ORM\Column(name="airfare", type="integer", nullable=false)
     */
    private $airfare;

    /**
     * @var string
     *
     * @ORM\Column(name="departure_airport", type="string", length=255, nullable=true)
     */
    private $departureAirport;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="text", nullable=true)
     */
    private $comments;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_number", type="string", length=255, nullable=false)
     */
    private $referenceNumber;

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
     * Set eventId
     *
     * @param integer $eventId
     * @return Orders
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
     * Set clientId
     *
     * @param integer $clientId
     * @return Orders
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
     * Set affiliateId
     *
     * @param integer $affiliateId
     * @return Orders
     */
    public function setAffiliateId($affiliateId)
    {
        $this->affiliateId = $affiliateId;

        return $this;
    }

    /**
     * Get affiliateId
     *
     * @return integer 
     */
    public function getAffiliateId()
    {
        return $this->affiliateId;
    }

    /**
     * Set userId
     *
     * @param integer $userId
     * @return Orders
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set resortRoomId
     *
     * @param integer $resortRoomId
     * @return Orders
     */
    public function setResortRoomId($resortRoomId)
    {
        $this->resortRoomId = $resortRoomId;

        return $this;
    }

    /**
     * Get resortRoomId
     *
     * @return integer 
     */
    public function getResortRoomId()
    {
        return $this->resortRoomId;
    }

    /**
     * Set roomCount
     *
     * @param integer $roomCount
     * @return Orders
     */
    public function setRoomCount($roomCount)
    {
        $this->roomCount = $roomCount;

        return $this;
    }

    /**
     * Get roomCount
     *
     * @return integer 
     */
    public function getRoomCount()
    {
        return $this->roomCount;
    }

    /**
     * Set travelDateFrom
     *
     * @param \DateTime $travelDateFrom
     * @return Orders
     */
    public function setTravelDateFrom($travelDateFrom)
    {
        $this->travelDateFrom = $travelDateFrom;

        return $this;
    }

    /**
     * Get travelDateFrom
     *
     * @return \DateTime 
     */
    public function getTravelDateFrom()
    {
        return $this->travelDateFrom;
    }

    /**
     * Set travelDateTo
     *
     * @param \DateTime $travelDateTo
     * @return Orders
     */
    public function setTravelDateTo($travelDateTo)
    {
        $this->travelDateTo = $travelDateTo;

        return $this;
    }

    /**
     * Get travelDateTo
     *
     * @return \DateTime 
     */
    public function getTravelDateTo()
    {
        return $this->travelDateTo;
    }

    /**
     * Set currency
     *
     * @param string $currency
     * @return Orders
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set couponId
     *
     * @param integer $couponId
     * @return Orders
     */
    public function setCouponId($couponId)
    {
        $this->couponId = $couponId;

        return $this;
    }

    /**
     * Get couponId
     *
     * @return integer 
     */
    public function getCouponId()
    {
        return $this->couponId;
    }

    /**
     * Set amountTotal
     *
     * @param float $amountTotal
     * @return Orders
     */
    public function setAmountTotal($amountTotal)
    {
        $this->amountTotal = $amountTotal;

        return $this;
    }

    /**
     * Get amountTotal
     *
     * @return float 
     */
    public function getAmountTotal()
    {
        return $this->amountTotal;
    }

    /**
     * Set amountDue
     *
     * @param float $amountDue
     * @return Orders
     */
    public function setAmountDue($amountDue)
    {
        $this->amountDue = $amountDue;

        return $this;
    }

    /**
     * Get amountDue
     *
     * @return float 
     */
    public function getAmountDue()
    {
        return $this->amountDue;
    }

    /**
     * Set depositAmount
     *
     * @param float $depositAmount
     * @return Orders
     */
    public function setDepositAmount($depositAmount)
    {
        $this->depositAmount = $depositAmount;

        return $this;
    }

    /**
     * Get depositAmount
     *
     * @return float 
     */
    public function getDepositAmount()
    {
        return $this->depositAmount;
    }

    /**
     * Set specialId
     *
     * @param integer $specialId
     * @return Orders
     */
    public function setSpecialId($specialId)
    {
        $this->specialId = $specialId;

        return $this;
    }

    /**
     * Get specialId
     *
     * @return integer 
     */
    public function getSpecialId()
    {
        return $this->specialId;
    }

    /**
     * Set preferredDiscount
     *
     * @param float $preferredDiscount
     * @return Orders
     */
    public function setPreferredDiscount($preferredDiscount)
    {
        $this->preferredDiscount = $preferredDiscount;

        return $this;
    }

    /**
     * Get preferredDiscount
     *
     * @return float 
     */
    public function getPreferredDiscount()
    {
        return $this->preferredDiscount;
    }

    /**
     * Set firstDueDate
     *
     * @param \DateTime $firstDueDate
     * @return Orders
     */
    public function setFirstDueDate($firstDueDate)
    {
        $this->firstDueDate = $firstDueDate;

        return $this;
    }

    /**
     * Get firstDueDate
     *
     * @return \DateTime 
     */
    public function getFirstDueDate()
    {
        return $this->firstDueDate;
    }

    /**
     * Set secondDueDate
     *
     * @param \DateTime $secondDueDate
     * @return Orders
     */
    public function setSecondDueDate($secondDueDate)
    {
        $this->secondDueDate = $secondDueDate;

        return $this;
    }

    /**
     * Get secondDueDate
     *
     * @return \DateTime 
     */
    public function getSecondDueDate()
    {
        return $this->secondDueDate;
    }

    /**
     * Set insurance
     *
     * @param integer $insurance
     * @return Orders
     */
    public function setInsurance($insurance)
    {
        $this->insurance = $insurance;

        return $this;
    }

    /**
     * Get insurance
     *
     * @return integer 
     */
    public function getInsurance()
    {
        return $this->insurance;
    }

    /**
     * Set airfare
     *
     * @param integer $airfare
     * @return Orders
     */
    public function setAirfare($airfare)
    {
        $this->airfare = $airfare;

        return $this;
    }

    /**
     * Get airfare
     *
     * @return integer 
     */
    public function getAirfare()
    {
        return $this->airfare;
    }

    /**
     * Set departureAirport
     *
     * @param string $departureAirport
     * @return Orders
     */
    public function setDepartureAirport($departureAirport)
    {
        $this->departureAirport = $departureAirport;

        return $this;
    }

    /**
     * Get departureAirport
     *
     * @return string 
     */
    public function getDepartureAirport()
    {
        return $this->departureAirport;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Orders
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
     * Set comments
     *
     * @param string $comments
     * @return Orders
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
     * Set referenceNumber
     *
     * @param string $referenceNumber
     * @return Orders
     */
    public function setReferenceNumber($referenceNumber)
    {
        $this->referenceNumber = $referenceNumber;

        return $this;
    }

    /**
     * Get referenceNumber
     *
     * @return string 
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return Orders
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
