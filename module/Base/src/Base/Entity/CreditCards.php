<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CreditCards
 *
 * @ORM\Table(name="credit_cards", indexes={@ORM\Index(name="FK_credit_cards_clients_id", columns={"client_id"})})
 * @ORM\Entity
 */
class CreditCards extends Base\BaseEntity
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
     * @ORM\Column(name="name_on_cc", type="string", length=64, nullable=false)
     */
    protected $nameOnCc;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=64, nullable=false)
     */
    protected $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="card_number", type="integer", nullable=false)
     */
    protected $cardNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="card_expiry_date", type="date", nullable=false)
     */
    protected $cardExpiryDate;

    /**
     * @var string
     *
     * @ORM\Column(name="csv_number", type="string", length=16, nullable=false)
     */
    protected $csvNumber;

    /**
     * @var \Base\Entity\Clients
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Clients")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     * })
     */
    protected $client;



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
     * Set nameOnCc
     *
     * @param string $nameOnCc
     * @return CreditCards
     */
    public function setNameOnCc($nameOnCc)
    {
        $this->nameOnCc = $nameOnCc;

        return $this;
    }

    /**
     * Get nameOnCc
     *
     * @return string 
     */
    public function getNameOnCc()
    {
        return $this->nameOnCc;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return CreditCards
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
     * Set cardNumber
     *
     * @param integer $cardNumber
     * @return CreditCards
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * Get cardNumber
     *
     * @return integer 
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * Set cardExpiryDate
     *
     * @param \DateTime $cardExpiryDate
     * @return CreditCards
     */
    public function setCardExpiryDate($cardExpiryDate)
    {
        $this->cardExpiryDate = $cardExpiryDate;

        return $this;
    }

    /**
     * Get cardExpiryDate
     *
     * @return \DateTime 
     */
    public function getCardExpiryDate()
    {
        return $this->cardExpiryDate;
    }

    /**
     * Set csvNumber
     *
     * @param string $csvNumber
     * @return CreditCards
     */
    public function setCsvNumber($csvNumber)
    {
        $this->csvNumber = $csvNumber;

        return $this;
    }

    /**
     * Get csvNumber
     *
     * @return string 
     */
    public function getCsvNumber()
    {
        return $this->csvNumber;
    }

    /**
     * Set client
     *
     * @param \Base\Entity\Clients $client
     * @return CreditCards
     */
    public function setClient(\Base\Entity\Clients $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Base\Entity\Clients 
     */
    public function getClient()
    {
        return $this->client;
    }
}
