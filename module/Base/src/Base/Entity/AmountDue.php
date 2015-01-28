<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AmountDue
 *
 * @ORM\Table(name="amount_due", indexes={@ORM\Index(name="FK_amount_due_orders_id", columns={"order_id"})})
 * @ORM\Entity
 */
class AmountDue extends Base\BaseEntity
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
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $amount;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deposit_due_date", type="date", nullable=false)
     */
    protected $depositDueDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="paid", type="boolean", nullable=false)
     */
    protected $paid = '0';

    /**
     * @var \Base\Entity\Orders
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Orders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     * })
     */
    protected $order;



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
     * @param string $amount
     * @return AmountDue
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set depositDueDate
     *
     * @param \DateTime $depositDueDate
     * @return AmountDue
     */
    public function setDepositDueDate($depositDueDate)
    {
        $this->depositDueDate = $depositDueDate;

        return $this;
    }

    /**
     * Get depositDueDate
     *
     * @return \DateTime 
     */
    public function getDepositDueDate()
    {
        return $this->depositDueDate;
    }

    /**
     * Set paid
     *
     * @param boolean $paid
     * @return AmountDue
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;

        return $this;
    }

    /**
     * Get paid
     *
     * @return boolean 
     */
    public function getPaid()
    {
        return $this->paid;
    }

    /**
     * Set order
     *
     * @param \Base\Entity\Orders $order
     * @return AmountDue
     */
    public function setOrder(\Base\Entity\Orders $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Base\Entity\Orders 
     */
    public function getOrder()
    {
        return $this->order;
    }
}
