<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * TempOrders
 *
 * @ORM\Table(name="temp_orders")
 * @ORM\Entity
 */
class TempOrders
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
     * @ORM\Column(name="client_name", type="string", length=100, nullable=true)
     */
    private $clientName;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_id", type="integer", nullable=false)
     */
    private $orderId;

    /**
     * @var integer
     *
     * @ORM\Column(name="room_count", type="integer", nullable=true)
     */
    private $roomCount = '1';

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
     * @var string
     *
     * @ORM\Column(name="reference_number", type="string", length=255, nullable=false)
     */
    private $referenceNumber;

    /**
     * @var integer
     *
     * @ORM\Column(name="cancel_order", type="integer", nullable=false)
     */
    private $cancelOrder = '0';

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
     * Set clientName
     *
     * @param string $clientName
     * @return TempOrders
     */
    public function setClientName($clientName)
    {
        $this->clientName = $clientName;

        return $this;
    }

    /**
     * Get clientName
     *
     * @return string 
     */
    public function getClientName()
    {
        return $this->clientName;
    }

    /**
     * Set orderId
     *
     * @param integer $orderId
     * @return TempOrders
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
     * Set roomCount
     *
     * @param integer $roomCount
     * @return TempOrders
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
     * Set couponId
     *
     * @param integer $couponId
     * @return TempOrders
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
     * @return TempOrders
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
     * @return TempOrders
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
     * Set travelDateFrom
     *
     * @param \DateTime $travelDateFrom
     * @return TempOrders
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
     * @return TempOrders
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
     * Set insurance
     *
     * @param integer $insurance
     * @return TempOrders
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
     * @return TempOrders
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
     * @return TempOrders
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
     * Set referenceNumber
     *
     * @param string $referenceNumber
     * @return TempOrders
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
     * Set cancelOrder
     *
     * @param integer $cancelOrder
     * @return TempOrders
     */
    public function setCancelOrder($cancelOrder)
    {
        $this->cancelOrder = $cancelOrder;

        return $this;
    }

    /**
     * Get cancelOrder
     *
     * @return integer 
     */
    public function getCancelOrder()
    {
        return $this->cancelOrder;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return TempOrders
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
