<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commissions
 *
 * @ORM\Table(name="commissions")
 * @ORM\Entity
 */
class Commissions
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
     * @var float
     *
     * @ORM\Column(name="amount", type="float", precision=10, scale=0, nullable=false)
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    private $type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status;

    /**
     * @var integer
     *
     * @ORM\Column(name="commission_for", type="integer", nullable=false)
     */
    private $commissionFor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime", nullable=false)
     */
    private $dateAdded;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_on", type="datetime", nullable=false)
     */
    private $updatedOn;

	 /**
     * @var \DateTime
     *
     * @ORM\Column(name="general", type="integer", nullable=false)
     */
    private $general;


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
     * Set amount
     *
     * @param float $amount
     * @return Commissions
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
     * Set commissionFor
     *
     * @param integer $commissionFor
     * @return Commissions
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
     * Set description
     *
     * @param string $description
     * @return Commissions
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Commissions
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Commissions
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return Commissions
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

    /**
     * Set updatedOn
     *
     * @param \DateTime $updatedOn
     * @return Commissions
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;

        return $this;
    }

    /**
     * Get updatedOn
     *
     * @return \DateTime 
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

	
	/**
     * Set general
     *
     * @param integer $general
     * @return Commissions
     */
    public function setGeneral($general)
    {
        $this->general = $general;

        return $this;
    }

    /**
     * Get general
     *
     * @return integer 
     */
    public function getGeneral()
    {
        return $this->general;
    }
}
