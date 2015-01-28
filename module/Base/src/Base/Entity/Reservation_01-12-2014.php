<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="FK_reservation_inventory_promo_id", columns={"promo_id"})})
 * @ORM\Entity
 */
class Reservation extends Base\BaseEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    protected $type;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="room_id", type="integer", nullable=false)
     */
    protected $roomId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="flight", type="boolean", nullable=false)
     */
    protected $flight = '0';
    
    

    /**
     * @var string
     *
     * @ORM\Column(name="departure_rom", type="string", length=64, nullable=true)
     */
    protected $departureFrom;

    /**
     * @var string
     *
     * @ORM\Column(name="departure_to", type="string", length=64, nullable=true)
     */
    protected $departureTo;

    /**
     * @var string
     *
     * @ORM\Column(name="return_from", type="string", length=64, nullable=true)
     */
    protected $returnFrom;

    /**
     * @var string
     *
     * @ORM\Column(name="return_to", type="string", length=64, nullable=true)
     */
    protected $returnTo;

    /**
     * @var string
     *
     * @ORM\Column(name="total_cost", type="decimal", precision=19, scale=2, nullable=false)
     */
    protected $totalCost;

    /**
     * @var string
     *
     * @ORM\Column(name="appli_discount", type="decimal", precision=10, scale=2, nullable=true)
     */
    protected $appliDiscount;

    /**
     * @var string
     *
     * @ORM\Column(name="final_cost", type="decimal", precision=19, scale=2, nullable=false)
     */
    protected $finalCost;

    /**
     * @var boolean
     *
     * @ORM\Column(name="payment_type", type="boolean", nullable=false)
     */
    protected $paymentType = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="deposit_amoun", type="decimal", precision=19, scale=2, nullable=false)
     */
    protected $depositAmoun;

    /**
     * @var boolean
     *
     * @ORM\Column(name="deposit_method", type="boolean", nullable=false)
     */
    protected $depositMethod = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="balans_after_deposit", type="decimal", precision=19, scale=2, nullable=false)
     */
    protected $balansAfterDeposit;

    /**
     * @var string
     *
     * @ORM\Column(name="next_payment_due", type="decimal", precision=19, scale=2, nullable=true)
     */
    protected $nextPaymentDue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="due_date1", type="date", nullable=true)
     */
    protected $dueDate1;

    /**
     * @var string
     *
     * @ORM\Column(name="final_payment_due", type="decimal", precision=19, scale=2, nullable=true)
     */
    protected $finalPaymentDue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="due_date2", type="date", nullable=true)
     */
    protected $dueDate2;

    /**
     * @var string
     *
     * @ORM\Column(name="client_notes", type="text", nullable=true)
     */
    protected $clientNotes;

    /**
     * @var string
     *
     * @ORM\Column(name="admin_notes", type="text", nullable=true)
     */
    protected $adminNotes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_from", type="date", nullable=true)
     */
    protected $dateFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_to", type="date", nullable=true)
     */
    protected $dateTo;

    /**
     * @var string
     *
     * @ORM\Column(name="flight_total_cost", type="decimal", precision=19, scale=2, nullable=false)
     */
    protected $flightTotalCost = '0.00';

    /**
     * @var integer
     *
     * @ORM\Column(name="no_of_days", type="integer", nullable=false)
     */
    protected $noOfDays = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="room_required", type="integer", nullable=false)
     */
    protected $roomRequired = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="room_rate", type="decimal", precision=19, scale=2, nullable=false)
     */
    protected $roomRate = '0.00';

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    protected $status = '1';

    /**
     * @var \Base\Entity\InventoryPromo
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\InventoryPromo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="promo_id", referencedColumnName="id")
     * })
     */
    protected $promo;
    
    /**
     * @var string
     *
     * @ORM\Column(name="merchant_fee", type="decimal", precision=19, scale=2, nullable=false)
     */
    protected $merchantFee;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date", nullable=true)
     */
    protected $createdAt;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="date", nullable=true)
     */
    protected $updatedAt;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="no_of_persons", type="integer", nullable=false)
     */
    protected $noOfPersons = '0';
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="excursion_cost", type="decimal", precision=19, scale=2, nullable=false)
     */
    protected $excursionCost = "0.00";
    
    /**
     * @var string
     *
     * @ORM\Column(name="transfer_cost", type="decimal", precision=19, scale=2, nullable=false)
     */
    protected $transferCost ="0.00";
    
    /**
     * @var string
     *
     * @ORM\Column(name="item_cost", type="decimal", precision=19, scale=2, nullable=false)
     */
    protected $itemCost = "0.00";
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_draft", type="boolean", nullable=false)
     */
    protected $isDraft = '0';
    
    /**
     * @var string
     *
     * @ORM\Column(name="reference_number", type="string", nullable=false)
     */
    protected $referenceNumber;
    
 /**
     * @var \Base\Entity\Reservation\Avp\Affiliates
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Avp\Affiliates")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="affiliate_id", referencedColumnName="id")
     * })
     */

    protected $affiliateId;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_booked", type="boolean", nullable=false)
     */
    protected $isBooked = '0';
    
    /**
     * @var string
     *
     * @ORM\Column(name="room_net_cost", type="decimal", precision=19, scale=2, nullable=false)
     */
    protected $roomNetCost = "0.00";
    
    /**
     * @var string
     *
     * @ORM\Column(name="addons_net_cost", type="decimal", precision=19, scale=2, nullable=false)
     */
    protected $addonsNetCost = "0.00";
    
    /**
     * @var string
     *
     * @ORM\Column(name="airport_name", type="text", nullable=true)
     */
    protected $airportName;
    
     /**
     * @var string
     *
     * @ORM\Column(name="discount_type", type="decimal", precision=19, scale=2, nullable=false)
     */
    protected $discountType = null;

    
    /**
     * @var string
     *
     * @ORM\Column(name="currency_code", type="string", length=64, nullable=true)
     */
    protected $currencyCode;

/**
     * @var boolean
     *
     * @ORM\Column(name="is_updated", type="boolean", nullable=false)
     */
    protected $isUpdated = '0';
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_refund", type="boolean", nullable=false)
     */
    protected $isRefund = '0';
    
    /**
     * @var string
     *
     * @ORM\Column(name="refund_amt", type="decimal", precision=11, scale=2, nullable=false)
     */
    protected $refundAmt='0.00';
    /**
     * @var string
     *
     * @ORM\Column(name="extra_amt_paid", type="decimal", precision=11, scale=2, nullable=false)
     */
    protected $extraAmtPaid='0.00';
    /**
     * @var string
     *
     * @ORM\Column(name="extra_dep_amt", type="decimal", precision=11, scale=2, nullable=false)
     */
    protected $extraDepAmt='0.00';
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_extra_paid", type="boolean", nullable=false)
     */
    protected $isExtraPaid='0';
    
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
     * Set type
     *
     * @param integer $type
     * @return Reservation
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }
    
    
    /**
     * Set roomId
     *
     * @param integer $roomId
     * @return Reservation
     */
    public function setRoomId($roomId)
    {
        $this->roomId = $roomId;

        return $this;
    }

    /**
     * Get roomId
     *
     * @return integer 
     */
    public function getRoomId()
    {
        return $this->roomId;
    }
    

    /**
     * Set flight
     *
     * @param boolean $flight
     * @return Reservation
     */
    public function setFlight($flight)
    {
        $this->flight = $flight;

        return $this;
    }

    /**
     * Get flight
     *
     * @return boolean 
     */
    public function getFlight()
    {
        return $this->flight;
    }

    /**
     * Set $departureFrom
     *
     * @param string $departureFrom
     * @return Reservation
     */
    public function setDepartureFrom($departureFrom)
    {
        $this->departureFrom = $departureFrom;

        return $this;
    }

    /**
     * Get departureFrom
     *
     * @return string 
     */
    public function getDepartureFrom()
    {
        return $this->departureFrom;
    }

    /**
     * Set departureTo
     *
     * @param string $departureTo
     * @return Reservation
     */
    public function setDepartureTo($departureTo)
    {
        $this->departureTo = $departureTo;

        return $this;
    }

    /**
     * Get departureTo
     *
     * @return string 
     */
    public function getDepartureTo()
    {
        return $this->departureTo;
    }

    /**
     * Set returnFrom
     *
     * @param string $returnFrom
     * @return Reservation
     */
    public function setReturnFrom($returnFrom)
    {
        $this->returnFrom = $returnFrom;

        return $this;
    }

    /**
     * Get returnFrom
     *
     * @return string 
     */
    public function getReturnFrom()
    {
        return $this->returnFrom;
    }

    /**
     * Set returnTo
     *
     * @param string $returnTo
     * @return Reservation
     */
    public function setReturnTo($returnTo)
    {
        $this->returnTo = $returnTo;

        return $this;
    }

    /**
     * Get returnTo
     *
     * @return string 
     */
    public function getReturnTo()
    {
        return $this->returnTo;
    }

    /**
     * Set totalCost
     *
     * @param string $totalCost
     * @return Reservation
     */
    public function setTotalCost($totalCost)
    {
        $this->totalCost = $totalCost;

        return $this;
    }

    /**
     * Get totalCost
     *
     * @return string 
     */
    public function getTotalCost()
    {
        return $this->totalCost;
    }

    /**
     * Set appliDiscount
     *
     * @param string $appliDiscount
     * @return Reservation
     */
    public function setAppliDiscount($appliDiscount)
    {
        $this->appliDiscount = $appliDiscount;

        return $this;
    }

    /**
     * Get appliDiscount
     *
     * @return string 
     */
    public function getAppliDiscount()
    {
        return $this->appliDiscount;
    }

    /**
     * Set finalCost
     *
     * @param string $finalCost
     * @return Reservation
     */
    public function setFinalCost($finalCost)
    {
        $this->finalCost = $finalCost;

        return $this;
    }

    /**
     * Get finalCost
     *
     * @return string 
     */
    public function getFinalCost()
    {
        return $this->finalCost;
    }

    /**
     * Set paymentType
     *
     * @param boolean $paymentType
     * @return Reservation
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    /**
     * Get paymentType
     *
     * @return boolean 
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * Set depositAmoun
     *
     * @param string $depositAmoun
     * @return Reservation
     */
    public function setDepositAmoun($depositAmoun)
    {
        $this->depositAmoun = $depositAmoun;

        return $this;
    }

    /**
     * Get depositAmoun
     *
     * @return string 
     */
    public function getDepositAmoun()
    {
        return $this->depositAmoun;
    }

    /**
     * Set depositMethod
     *
     * @param boolean $depositMethod
     * @return Reservation
     */
    public function setDepositMethod($depositMethod)
    {
        $this->depositMethod = $depositMethod;

        return $this;
    }

    /**
     * Get depositMethod
     *
     * @return boolean 
     */
    public function getDepositMethod()
    {
        return $this->depositMethod;
    }

    /**
     * Set balansAfterDeposit
     *
     * @param string $balansAfterDeposit
     * @return Reservation
     */
    public function setBalansAfterDeposit($balansAfterDeposit)
    {
        $this->balansAfterDeposit = $balansAfterDeposit;

        return $this;
    }

    /**
     * Get balansAfterDeposit
     *
     * @return string 
     */
    public function getBalansAfterDeposit()
    {
        return $this->balansAfterDeposit;
    }

    /**
     * Set nextPaymentDue
     *
     * @param string $nextPaymentDue
     * @return Reservation
     */
    public function setNextPaymentDue($nextPaymentDue)
    {
        $this->nextPaymentDue = $nextPaymentDue;

        return $this;
    }

    /**
     * Get nextPaymentDue
     *
     * @return string 
     */
    public function getNextPaymentDue()
    {
        return $this->nextPaymentDue;
    }

    /**
     * Set dueDate1
     *
     * @param \DateTime $dueDate1
     * @return Reservation
     */
    public function setDueDate1($dueDate1)
    {
        $this->dueDate1 = $dueDate1;

        return $this;
    }

    /**
     * Get dueDate1
     *
     * @return \DateTime 
     */
    public function getDueDate1()
    {
        return $this->dueDate1;
    }

    /**
     * Set finalPaymentDue
     *
     * @param string $finalPaymentDue
     * @return Reservation
     */
    public function setFinalPaymentDue($finalPaymentDue)
    {
        $this->finalPaymentDue = $finalPaymentDue;

        return $this;
    }

    /**
     * Get finalPaymentDue
     *
     * @return string 
     */
    public function getFinalPaymentDue()
    {
        return $this->finalPaymentDue;
    }

    /**
     * Set dueDate2
     *
     * @param \DateTime $dueDate2
     * @return Reservation
     */
    public function setDueDate2($dueDate2)
    {
        $this->dueDate2 = $dueDate2;

        return $this;
    }

    /**
     * Get dueDate2
     *
     * @return \DateTime 
     */
    public function getDueDate2()
    {
        return $this->dueDate2;
    }

    /**
     * Set clientNotes
     *
     * @param string $clientNotes
     * @return Reservation
     */
    public function setClientNotes($clientNotes)
    {
        $this->clientNotes = $clientNotes;

        return $this;
    }

    /**
     * Get clientNotes
     *
     * @return string 
     */
    public function getClientNotes()
    {
        return $this->clientNotes;
    }

    /**
     * Set adminNotes
     *
     * @param string $adminNotes
     * @return Reservation
     */
    public function setAdminNotes($adminNotes)
    {
        $this->adminNotes = $adminNotes;

        return $this;
    }

    /**
     * Get adminNotes
     *
     * @return string 
     */
    public function getAdminNotes()
    {
        return $this->adminNotes;
    }

    /**
     * Set dateFrom
     *
     * @param \DateTime $dateFrom
     * @return Reservation
     */
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    /**
     * Get dateFrom
     *
     * @return \DateTime 
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * Set dateTo
     *
     * @param \DateTime $dateTo
     * @return Reservation
     */
    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    /**
     * Get dateTo
     *
     * @return \DateTime 
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * Set flightTotalCost
     *
     * @param string $flightTotalCost
     * @return Reservation
     */
    public function setFlightTotalCost($flightTotalCost)
    {
        $this->flightTotalCost = $flightTotalCost;

        return $this;
    }

    /**
     * Get flightTotalCost
     *
     * @return string 
     */
    public function getFlightTotalCost()
    {
        return $this->flightTotalCost;
    }

    /**
     * Set noOfDays
     *
     * @param integer $noOfDays
     * @return Reservation
     */
    public function setNoOfDays($noOfDays)
    {
        $this->noOfDays = $noOfDays;

        return $this;
    }

    /**
     * Get noOfDays
     *
     * @return integer 
     */
    public function getNoOfDays()
    {
        return $this->noOfDays;
    }

    /**
     * Set roomRequired
     *
     * @param integer $roomRequired
     * @return Reservation
     */
    public function setRoomRequired($roomRequired)
    {
        $this->roomRequired = $roomRequired;

        return $this;
    }

    /**
     * Get roomRequired
     *
     * @return integer 
     */
    public function getRoomRequired()
    {
        return $this->roomRequired;
    }

    /**
     * Set roomRate
     *
     * @param string $roomRate
     * @return Reservation
     */
    public function setRoomRate($roomRate)
    {
        $this->roomRate = $roomRate;

        return $this;
    }

    /**
     * Get roomRate
     *
     * @return string 
     */
    public function getRoomRate()
    {
        return $this->roomRate;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Reservation
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
     * Set promo
     *
     * @param \Base\Entity\InventoryPromo $promo
     * @return Reservation
     */
    public function setPromo(\Base\Entity\InventoryPromo $promo = null)
    {
        $this->promo = $promo;

        return $this;
    }

    /**
     * Get promo
     *
     * @return \Base\Entity\InventoryPromo 
     */
    public function getPromo()
    {
        return $this->promo;
    }
    
    /**
     * Set merchantFee
     *
     * @param string $merchantFee
     * @return Reservation
     */
    public function setMerchantFee($merchantFee)
    {
        $this->merchantFee = $merchantFee;

        return $this;
    }

    /**
     * Get finalCost
     *
     * @return string 
     */
    public function getMerchantFee()
    {
        return $this->merchantFee;
    }
    
    /**
     * Set createdAt
     *
     * @param string $createdAt
     * @return Reservation
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    
     /**
     * Get finalCost
     *
     * @return string 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param string $updatedAt
     * @return Reservation
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    
     /**
     * Get updatedAt
     *
     * @return string 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    /**
     * Set noOfDays
     *
     * @param integer $noOfPersons
     * @return Reservation
     */
    public function setNoOfPersons($noOfPersons)
    {
        $this->noOfPersons = $noOfPersons;

        return $this;
    }

    /**
     * Get noOfPersons
     *
     * @return integer 
     */
    public function getNoOfPersons()
    {
        return $this->noOfPersons;
    }
    
    /**
     * Set excursionCost
     *
     * @param string $excursionCost
     * @return Reservation
     */
    public function setExcursionCost($excursionCost)
    {
        $this->excursionCost = $excursionCost;

        return $this;
    }

    /**
     * Get excursionCost
     *
     * @return string 
     */
    public function getExcursionCost()
    {
        return $this->excursionCost;
    }
    
    
    /**
     * Set transferCost
     *
     * @param string $transferCost
     * @return Reservation
     */
    public function setTransferCost($transferCost)
    {
        $this->transferCost = $transferCost;

        return $this;
    }

    /**
     * Get transferCost
     *
     * @return string 
     */
    public function getTransferCost()
    {
        return $this->transferCost;
    }
    
    /**
     * Set itemCost
     *
     * @param string $itemCost
     * @return Reservation
     */
    public function setItemCost($itemCost)
    {
        $this->itemCost = $itemCost;

        return $this;
    }

    /**
     * Get itemCost
     *
     * @return string 
     */
    public function getItemCost()
    {
        return $this->itemCost;
    }
    
    /**
     * Set isDraft
     *
     * @param boolean $isDraft
     * @return Reservation
     */
    public function setIsDraft($isDraft)
    {
        $this->isDraft = $isDraft;

        return $this;
    }

    /**
     * Get isDraft
     *
     * @return boolean 
     */
    public function getIsDraft()
    {
        return $this->isDraft;
    }
    
    /**
     * Set referenceNumber
     *
     * @param string $referenceNumber
     * @return Reservation
     */
    public function setReferenceNumber($referenceNumber)
    {
        $this->referenceNumber = $referenceNumber;

        return $this;
    }

    /**
     * Get $referenceNumber
     *
     * @return string 
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }
    
    /**
     * Set affiliateId
     *
     * @param integer $affiliateId
     * @return Reservation
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
     * Set isBooked
     *
     * @param boolean $isBooked
     * @return Reservation
     */
    public function setIsBooked($isBooked)
    {
        $this->isBooked = $isBooked;

        return $this;
    }

    /**
     * Get isBooked
     *
     * @return boolean 
     */
    public function getIsBooked()
    {
        return $this->isBooked;
    }
    
    /**
     * Set roomNetCost
     *
     * @param string $roomNetCost
     * @return Reservation
     */
    public function setRoomNetCost($roomNetCost)
    {
        $this->roomNetCost = $roomNetCost;

        return $this;
    }

    /**
     * Get roomNetCost
     *
     * @return string 
     */
    public function getRoomNetCost()
    {
        return $this->roomNetCost;
    }
    
    /**
     * Set addonsNetCost
     *
     * @param string $addonsNetCost
     * @return Reservation
     */
    public function setAddonsNetCost($addonsNetCost)
    {
        $this->addonsNetCost = $addonsNetCost;

        return $this;
    }

    /**
     * Get addonsNetCost
     *
     * @return string 
     */
    public function getAddonsNetCost()
    {
        return $this->addonsNetCost;
    }
    
    /**
     * Set airportName
     *
     * @param string $airportName
     * @return Reservation
     */
    public function setAirportName($airportName)
    {
        $this->airportName = $airportName;

        return $this;
    }

    /**
     * Get airportName
     *
     * @return string 
     */
    public function getAirportName()
    {
        return $this->airportName;
    }
    
    /**
     * Set discountType
     *
     * @param integer $discountType
     * @return Reservation
     */
    public function setDiscountType($discountType)
    {
        $this->discountType = $discountType;

        return $this;
    }

    /**
     * Get discountType
     *
     * @return integer 
     */
    public function getDiscountType()
    {
        return $this->discountType;
    }

   /**
     * Set currencyCode
     *
     * @param string $currencyCode
     * @return Reservation
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * Get currencyCode
     *
     * @return string 
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }
    
    /**
     * Set isUpdated
     *
     * @param integer $isUpdated
     * @return Reservation
     */
    public function setIsUpdated($isUpdated)
    {
        $this->isUpdated = $isUpdated;

        return $this;
    }

    /**
     * Get isUpdated
     *
     * @return integer 
     */
    public function getIsUpdated()
    {
        return $this->isUpdated;
    }
    /**
     * Set isRefund
     *
     * @param integer $isRefund
     * @return Reservation
     */
    public function setIsRefund($isRefund)
    {
        $this->isRefund = $isRefund;

        return $this;
    }

    /**
     * Get isRefund
     *
     * @return integer 
     */
    public function getIsRefund()
    {
        return $this->isRefund;
    }
    /**
     * Set refundAmt
     *
     * @param integer $refundAmt
     * @return Reservation
     */
    public function setRefundAmt($refundAmt)
    {
        $this->refundAmt = $refundAmt;

        return $this;
    }

    /**
     * Get refundAmt
     *
     * @return integer 
     */
    public function getRefundAmt()
    {
        return $this->refundAmt;
    }
    /**
     * Set extraAmtPaid
     *
     * @param integer $extraAmtPaid
     * @return Reservation
     */
    public function setExtraAmtPaid($extraAmtPaid)
    {
        $this->extraAmtPaid = $extraAmtPaid;

        return $this;
    }

    /**
     * Get extraAmtPaid
     *
     * @return integer 
     */
    public function getExtraAmtPaid()
    {
        return $this->extraAmtPaid;
    }
    /**
     * Set isExtraPaid
     *
     * @param integer $isExtraPaid
     * @return Reservation
     */
    public function setIsExtraPaid($isExtraPaid)
    {
        $this->isExtraPaid = $isExtraPaid;

        return $this;
    }

    /**
     * Get isExtraPaid
     *
     * @return integer 
     */
    public function getIsExtraPaid()
    {
        return $this->isExtraPaid;
    }
    /**
     * Set extraDepAmt
     *
     * @param integer $extraDepAmt
     * @return Reservation
     */
    public function setExtraDepAmt($extraDepAmt)
    {
        $this->extraDepAmt = $extraDepAmt;

        return $this;
    }

    /**
     * Get extraDepAmt
     *
     * @return integer 
     */
    public function getExtraDepAmt()
    {
        return $this->extraDepAmt;
    }
}
