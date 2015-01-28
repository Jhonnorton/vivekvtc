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
    protected $departureRom;

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
     * @var \Base\Entity\InventoryPromo
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\InventoryPromo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="promo_id", referencedColumnName="id")
     * })
     */
    protected $promo;



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
     * Set departureRom
     *
     * @param string $departureRom
     * @return Reservation
     */
    public function setDepartureRom($departureRom)
    {
        $this->departureRom = $departureRom;

        return $this;
    }

    /**
     * Get departureRom
     *
     * @return string 
     */
    public function getDepartureRom()
    {
        return $this->departureRom;
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
}
