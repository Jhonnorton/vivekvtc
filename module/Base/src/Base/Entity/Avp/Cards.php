<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cards
 *
 * @ORM\Table(name="cards")
 * @ORM\Entity
 */
class Cards
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="number", type="string", length=255, nullable=false)
     */
    private $number;

    /**
     * @var integer
     *
     * @ORM\Column(name="expiry_month", type="integer", nullable=false)
     */
    private $expiryMonth;

    /**
     * @var integer
     *
     * @ORM\Column(name="expiry_year", type="integer", nullable=false)
     */
    private $expiryYear;

    /**
     * @var integer
     *
     * @ORM\Column(name="cvv", type="integer", nullable=false)
     */
    private $cvv;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="client_id", type="integer", nullable=false)
     */
    private $clientId;

    /**
     * @var string
     *
     * @ORM\Column(name="billing_address", type="text", nullable=false)
     */
    private $billingAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255, nullable=false)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=false)
     */
    private $country;

    /**
     * @var integer
     *
     * @ORM\Column(name="zip", type="integer", nullable=false)
     */
    private $zip;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added_on", type="datetime", nullable=false)
     */
    private $addedOn;

    /**
     * @var string
     *
     * @ORM\Column(name="card_ip", type="string", length=100, nullable=false)
     */
    private $cardIp;



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
     * Set name
     *
     * @param string $name
     * @return Cards
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set number
     *
     * @param string $number
     * @return Cards
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return string 
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set expiryMonth
     *
     * @param integer $expiryMonth
     * @return Cards
     */
    public function setExpiryMonth($expiryMonth)
    {
        $this->expiryMonth = $expiryMonth;

        return $this;
    }

    /**
     * Get expiryMonth
     *
     * @return integer 
     */
    public function getExpiryMonth()
    {
        return $this->expiryMonth;
    }

    /**
     * Set expiryYear
     *
     * @param integer $expiryYear
     * @return Cards
     */
    public function setExpiryYear($expiryYear)
    {
        $this->expiryYear = $expiryYear;

        return $this;
    }

    /**
     * Get expiryYear
     *
     * @return integer 
     */
    public function getExpiryYear()
    {
        return $this->expiryYear;
    }

    /**
     * Set cvv
     *
     * @param integer $cvv
     * @return Cards
     */
    public function setCvv($cvv)
    {
        $this->cvv = $cvv;

        return $this;
    }

    /**
     * Get cvv
     *
     * @return integer 
     */
    public function getCvv()
    {
        return $this->cvv;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Cards
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
     * Set clientId
     *
     * @param integer $clientId
     * @return Cards
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
     * Set billingAddress
     *
     * @param string $billingAddress
     * @return Cards
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    /**
     * Get billingAddress
     *
     * @return string 
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Cards
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Cards
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Cards
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set zip
     *
     * @param integer $zip
     * @return Cards
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return integer 
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * Set addedOn
     *
     * @param \DateTime $addedOn
     * @return Cards
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

    /**
     * Set cardIp
     *
     * @param string $cardIp
     * @return Cards
     */
    public function setCardIp($cardIp)
    {
        $this->cardIp = $cardIp;

        return $this;
    }

    /**
     * Get cardIp
     *
     * @return string 
     */
    public function getCardIp()
    {
        return $this->cardIp;
    }
}
