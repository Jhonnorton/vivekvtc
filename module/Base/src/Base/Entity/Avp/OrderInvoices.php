<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderInvoices
 *
 * @ORM\Table(name="order_invoices")
 * @ORM\Entity
 */
class OrderInvoices extends \Base\Entity\Base\BaseEntity
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
     * @ORM\Column(name="order_id", type="integer", nullable=false)
     */
    protected $orderId;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_code", type="string", length=50, nullable=false)
     */
    protected $currencyCode;

    /**
     * @var string
     *
     * @ORM\Column(name="transaction_id", type="string", length=255, nullable=false)
     */
    protected $transactionId;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_paid", type="float", precision=10, scale=0, nullable=false)
     */
    protected $amountPaid;

    /**
     * @var string
     *
     * @ORM\Column(name="payment_mode", type="string", length=255, nullable=false)
     */
    protected $paymentMode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime", nullable=false)
     */
    protected $dateAdded;



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
     * @return OrderInvoices
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
     * Set currencyCode
     *
     * @param string $currencyCode
     * @return OrderInvoices
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
     * Set transactionId
     *
     * @param string $transactionId
     * @return OrderInvoices
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    /**
     * Get transactionId
     *
     * @return string 
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * Set amountPaid
     *
     * @param float $amountPaid
     * @return OrderInvoices
     */
    public function setAmountPaid($amountPaid)
    {
        $this->amountPaid = $amountPaid;

        return $this;
    }

    /**
     * Get amountPaid
     *
     * @return float 
     */
    public function getAmountPaid()
    {
        return $this->amountPaid;
    }

    /**
     * Set paymentMode
     *
     * @param string $paymentMode
     * @return OrderInvoices
     */
    public function setPaymentMode($paymentMode)
    {
        $this->paymentMode = $paymentMode;

        return $this;
    }

    /**
     * Get paymentMode
     *
     * @return string 
     */
    public function getPaymentMode()
    {
        return $this->paymentMode;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return OrderInvoices
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
