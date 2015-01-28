<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * AffiliatePaymentOptions
 *
 * @ORM\Table(name="affiliate_payment_options")
 * @ORM\Entity
 */
class AffiliatePaymentOptions
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
     * @ORM\Column(name="payment_type", type="string", length=100, nullable=true)
     */
    private $paymentType;

    /**
     * @var string
     *
     * @ORM\Column(name="paypal_email", type="string", length=100, nullable=true)
     */
    private $paypalEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="paypal_info", type="string", length=200, nullable=true)
     */
    private $paypalInfo;

    /**
     * @var string
     *
     * @ORM\Column(name="cheque_name", type="string", length=100, nullable=true)
     */
    private $chequeName;

    /**
     * @var string
     *
     * @ORM\Column(name="cheque_address", type="text", nullable=true)
     */
    private $chequeAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="etransfer_ac_num", type="string", length=100, nullable=true)
     */
    private $etransferAcNum;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added_on", type="datetime", nullable=false)
     */
    private $addedOn;



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
     * @return AffiliatePaymentOptions
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
     * Set paymentType
     *
     * @param string $paymentType
     * @return AffiliatePaymentOptions
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    /**
     * Get paymentType
     *
     * @return string 
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * Set paypalEmail
     *
     * @param string $paypalEmail
     * @return AffiliatePaymentOptions
     */
    public function setPaypalEmail($paypalEmail)
    {
        $this->paypalEmail = $paypalEmail;

        return $this;
    }

    /**
     * Get paypalEmail
     *
     * @return string 
     */
    public function getPaypalEmail()
    {
        return $this->paypalEmail;
    }

    /**
     * Set paypalInfo
     *
     * @param string $paypalInfo
     * @return AffiliatePaymentOptions
     */
    public function setPaypalInfo($paypalInfo)
    {
        $this->paypalInfo = $paypalInfo;

        return $this;
    }

    /**
     * Get paypalInfo
     *
     * @return string 
     */
    public function getPaypalInfo()
    {
        return $this->paypalInfo;
    }

    /**
     * Set chequeName
     *
     * @param string $chequeName
     * @return AffiliatePaymentOptions
     */
    public function setChequeName($chequeName)
    {
        $this->chequeName = $chequeName;

        return $this;
    }

    /**
     * Get chequeName
     *
     * @return string 
     */
    public function getChequeName()
    {
        return $this->chequeName;
    }

    /**
     * Set chequeAddress
     *
     * @param string $chequeAddress
     * @return AffiliatePaymentOptions
     */
    public function setChequeAddress($chequeAddress)
    {
        $this->chequeAddress = $chequeAddress;

        return $this;
    }

    /**
     * Get chequeAddress
     *
     * @return string 
     */
    public function getChequeAddress()
    {
        return $this->chequeAddress;
    }

    /**
     * Set etransferAcNum
     *
     * @param string $etransferAcNum
     * @return AffiliatePaymentOptions
     */
    public function setEtransferAcNum($etransferAcNum)
    {
        $this->etransferAcNum = $etransferAcNum;

        return $this;
    }

    /**
     * Get etransferAcNum
     *
     * @return string 
     */
    public function getEtransferAcNum()
    {
        return $this->etransferAcNum;
    }

    /**
     * Set addedOn
     *
     * @param \DateTime $addedOn
     * @return AffiliatePaymentOptions
     */
    public function setAddedOn($addedOn)
    {
        $this->addedOn = $addedOn;

        return $this;
    }

    /**
     * Get addedOn
     *
     * @return \DateTime 
     */
    public function getAddedOn()
    {
        return $this->addedOn;
    }
}
