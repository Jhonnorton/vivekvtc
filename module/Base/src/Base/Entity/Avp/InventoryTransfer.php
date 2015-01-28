<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * InventoryTransfer
 *
 * @ORM\Table(name="inventory_transfer")
 * @ORM\Entity
 */
class InventoryTransfer
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
     * @ORM\Column(name="resort_id", type="integer", nullable=false)
     */
    protected $resortId;

    /**
     * @var string
     *
     * @ORM\Column(name="hotel_name", type="string", length=50, nullable=true)
     */
    protected $hotelName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="supplier_name", type="string", length=128, nullable=false)
     */
    protected $supplierName;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="number_available", type="integer", nullable=false)
     */
    protected $numberAvailable = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_to", type="date", nullable=true)
     */
    protected $dateTo;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_from", type="date", nullable=true)
     */
    protected $dateFrom;

    /**
     * @var string
     *
     * @ORM\Column(name="net_price", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $netPrice = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="gross_price", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $grossPrice = '0.00';
    
    /**
     * @var string
     *
     * @ORM\Column(name="cost_multiplier", type="integer", length=2, nullable=false)
     */
    protected $costMultiplier = '0';
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    protected $transferName;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="linked_to", type="integer", nullable=false)
     */
    protected $linkedTo;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="event_id", type="integer", nullable=true)
     */
    protected $eventId;

    /**
     * @var integer
     *
     * @ORM\Column(name="cruise_id", type="integer", nullable=true)
     */
    protected $cruiseId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string",length=128, nullable=true)
     */
    protected $email;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="phone", type="integer", nullable=true)
     */
    protected $phone;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="notes", type="text", nullable=true)
     */
    protected $notes;



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
     * Set resortId
     *
     * @param integer $resortId
     * @return InventoryTransfer
     */
    public function setResortId($resortId)
    {
        $this->resortId = $resortId;

        return $this;
    }

    /**
     * Get resortId
     *
     * @return integer 
     */
    public function getResortId()
    {
        return $this->resortId;
    }

    /**
     * Set hotelName
     *
     * @param string $hotelName
     * @return InventoryTransfer
     */
    public function setHotelName($hotelName)
    {
        $this->hotelName = $hotelName;

        return $this;
    }

    /**
     * Get hotelName
     *
     * @return string 
     */
    public function getHotelName()
    {
        return $this->hotelName;
    }
    
    /**
     * Set supplierName
     *
     * @param string $supplierName
     * @return InventoryTransfer
     */
    public function setSupplierName($supplierName)
    {
        $this->supplierName = $supplierName;

        return $this;
    }

    /**
     * Get supplierName
     *
     * @return string 
     */
    public function getSupplierName()
    {
        return $this->supplierName;
    }
    /**
     * Set dateTo
     *
     * @param \DateTime $dateTo
     * @return InventoryTransfer
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
     * Set dateFrom
     *
     * @param \DateTime $dateFrom
     * @return InventoryTransfer
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
     * Set netPrice
     *
     * @param string $netPrice
     * @return InventoryTransfer
     */
    public function setNetPrice($netPrice)
    {
        $this->netPrice = $netPrice;

        return $this;
    }

    /**
     * Get netPrice
     *
     * @return string 
     */
    public function getNetPrice()
    {
        return $this->netPrice;
    }

    /**
     * Set grossPrice
     *
     * @param string $grossPrice
     * @return InventoryTransfer
     */
    public function setGrossPrice($grossPrice)
    {
        $this->grossPrice = $grossPrice;

        return $this;
    }

    /**
     * Get grossPrice
     *
     * @return string 
     */
    public function getGrossPrice()
    {
        return $this->grossPrice;
    }
    
    /**
     * @param string $costMultiplier
     */
    public function setCostMultiplier($costMultiplier)
    {
        $this->costMultiplier = $costMultiplier;
        return $this;
    }
    
    /**
     * @return the $costMultiplier
     */
    public function getCostMultiplier()
    {
        return $this->costMultiplier;
    }

	/**
     * Set numberAvailable
     *
     * @param integer $numberAvailable
     * @return InventoryExcursion
     */
    public function setNumberAvailable($numberAvailable)
    {
        $this->numberAvailable = $numberAvailable;

        return $this;
    }

    /**
     * Get numberAvailable
     *
     * @return integer 
     */
    public function getNumberAvailable()
    {
        return $this->numberAvailable;
    }
    
    /**
     * Set excursionName
     *
     * @param string $transferName
     * @return InventoryTransfer
     */
    public function setTransferName($transferName)
    {
        $this->transferName = $transferName;

        return $this;
    }

    /**
     * Get transferName
     *
     * @return string 
     */
    public function getTransferName()
    {
        return $this->transferName;
    }
    
    /**
     * Set linkedTo
     *
     * @param integer $linkedTo
     * @return InventoryItem
     */
    public function setLinkedTo($linkedTo)
    {
        $this->linkedTo = $linkedTo;

        return $this;
    }

    /**
     * Get linkedTo
     *
     * @return integer 
     */
    public function getLinkedTo()
    {
        return $this->linkedTo;
    }
    
    /**
     * Set eventId
     *
     * @param integer $eventId
     * @return InventoryTransfer
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return integer 
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Set cruiseId
     *
     * @param integer $cruiseId
     * @return InventoryTransfer
     */
    public function setCruiseId($cruiseId)
    {
        $this->cruiseId = $cruiseId;

        return $this;
    }

    /**
     * Get cruiseId
     *
     * @return integer 
     */
    public function getCruiseId()
    {
        return $this->cruiseId;
    }
    
    /**
     * Set email
     *
     * @param string $email
     * @return InventoryTransfer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Set phone
     *
     * @param integer $phone
     * @return InventoryItem
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer 
     */
    public function getPhone()
    {
        return $this->phone;
    }
    
    /**
     * Set notes
     *
     * @param integer $notes
     * @return InventoryItem
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return integer 
     */
    public function getNotes()
    {
        return $this->notes;
    }
}
