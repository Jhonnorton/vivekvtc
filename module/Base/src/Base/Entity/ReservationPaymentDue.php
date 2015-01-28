<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationPaymentDue
 *
 * @ORM\Table(name="reservation_payment_due")
 * @ORM\Entity
 */
class ReservationPaymentDue
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
     * @var \Base\Entity\Reservation
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Reservation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reservation_id", referencedColumnName="id")
     * })
     */
    private $reservation;
    
    /**
     * @var string
     *
     * @ORM\Column(name="amount_due", type="decimal", precision=19, scale=2, nullable=true)
     */
    protected $paymentDue;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="due_date", type="date", nullable=true)
     */
    protected $dueDate;
    
     /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    protected $status = 0;
    
     /**
     * @var boolean
     *
     * @ORM\Column(name="is_manual", type="boolean", nullable=false)
     */
    protected $isManual = 0;



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
     * Set reservation
     *
     * @param \Base\Entity\Reservation $reservation
     * @return ReservationTransfer
     */
    public function setReservation(\Base\Entity\Reservation $reservation = null)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \Base\Entity\Reservation 
     */
    public function getReservation()
    {
        return $this->reservation;
    }
    
    /**
     * Set paymentDue
     *
     * @param string $paymentDue
     * @return Reservation
     */
    public function setPaymentDue($paymentDue)
    {
        $this->paymentDue = $paymentDue;

        return $this;
    }

    /**
     * Get paymentDue
     *
     * @return string 
     */
    public function getpaymentDue()
    {
        return $this->paymentDue;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     * @return Reservation
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate1
     *
     * @return \DateTime 
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }
    
    /**
     * Set status
     *
     * @param integer $status
     * @return ReservationPaymentDue
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
     * Set isManual
     *
     * @param integer $isManual
     * @return ReservationPaymentDue
     */
    public function setIsManual($isManual)
    {
        $this->isManual = $isManual;

        return $this;
    }

    /**
     * Get isManual
     *
     * @return integer 
     */
    public function getIsManual()
    {
        return $this->isManual;
    }
}
