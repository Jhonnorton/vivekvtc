<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * AffiliateCommissions
 *
 * @ORM\Table(name="affiliate_commissions")
 * @ORM\Entity
 */
class AffiliateCommissions
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
     * @ORM\Column(name="affiliate_id", type="integer", nullable=false)
     */
    private $affiliateId;

    /**
     * @var string
     *
     * @ORM\Column(name="event_name", type="string", length=200, nullable=true)
     */
    private $eventName;

    /**
     * @var integer
     *
     * @ORM\Column(name="commission_for", type="integer", nullable=true)
     */
    private $commissionFor;

    /**
     * @var integer
     *
     * @ORM\Column(name="commission_id", type="integer", nullable=true)
     */
    private $commissionId;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_id", type="integer", nullable=true)
     */
    private $orderId;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    private $type;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float", precision=10, scale=0, nullable=true)
     */
    private $amount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="due_date", type="date", nullable=true)
     */
    private $dueDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="paid_date", type="integer", nullable=true)
     */
    private $paidDate;



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
     * Set affiliateId
     *
     * @param integer $affiliateId
     * @return AffiliateCommissions
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
     * Set eventName
     *
     * @param string $eventName
     * @return AffiliateCommissions
     */
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;

        return $this;
    }

    /**
     * Get eventName
     *
     * @return string 
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * Set commissionFor
     *
     * @param integer $commissionFor
     * @return AffiliateCommissions
     */
    public function setCommissionFor($commissionFor)
    {
        $this->commissionFor = $commissionFor;

        return $this;
    }

    /**
     * Get commissionFor
     *
     * @return integer 
     */
    public function getCommissionFor()
    {
        return $this->commissionFor;
    }

    /**
     * Set commissionId
     *
     * @param integer $commissionId
     * @return AffiliateCommissions
     */
    public function setCommissionId($commissionId)
    {
        $this->commissionId = $commissionId;

        return $this;
    }

    /**
     * Get commissionId
     *
     * @return integer 
     */
    public function getCommissionId()
    {
        return $this->commissionId;
    }

    /**
     * Set orderId
     *
     * @param integer $orderId
     * @return AffiliateCommissions
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
     * Set status
     *
     * @param integer $status
     * @return AffiliateCommissions
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
     * Set type
     *
     * @param integer $type
     * @return AffiliateCommissions
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
     * Set amount
     *
     * @param float $amount
     * @return AffiliateCommissions
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     * @return AffiliateCommissions
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime 
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set paidDate
     *
     * @param integer $paidDate
     * @return AffiliateCommissions
     */
    public function setPaidDate($paidDate)
    {
        $this->paidDate = $paidDate;

        return $this;
    }

    /**
     * Get paidDate
     *
     * @return integer 
     */
    public function getPaidDate()
    {
        return $this->paidDate;
    }
}
