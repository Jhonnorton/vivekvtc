<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InventoryItem
 *
 * @ORM\Table(name="inventory_item", indexes={@ORM\Index(name="FK_inventory_item_inventory_hotels_id", columns={"resort_id"}), @ORM\Index(name="FK_inventory_item_inventory_event_id", columns={"event_id"}), @ORM\Index(name="FK_inventory_item_inventory_cruise_id", columns={"cruise_id"})})
 * @ORM\Entity
 */
class InventoryItem extends Base\BaseEntity
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="linked_to", type="integer", nullable=false)
     */
    protected $linkedTo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="number_available", type="integer", nullable=false)
     */
    protected $numberAvailable = '0';

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
     * @var integer
     *
     * @ORM\Column(name="resort_id", type="integer", nullable=true)
     */
    protected $resortId;

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
     * @var integer
     *
     * @ORM\Column(name="event_category_id", type="integer", nullable=true)
     */
    protected $eventCategoryId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="supplier_name", type="string", length=128, nullable=false)
     */
    protected $supplierName;
    
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
     * @var string
     *
     * @ORM\Column(name="image", type="string", nullable=true)
     */
    protected $image;



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
     * @return InventoryItem
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
     * Set numberAvailable
     *
     * @param integer $numberAvailable
     * @return InventoryItem
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
     * Set netPrice
     *
     * @param string $netPrice
     * @return InventoryItem
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
     * @return InventoryItem
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
     * Set resortId
     *
     * @param integer $resortId
     * @return InventoryItem
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
     * Set eventId
     *
     * @param integer $eventId
     * @return InventoryItem
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
     * @return InventoryItem
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
     * Set eventCategoryId
     *
     * @param integer $eventCategoryId
     * @return InventoryItem
     */
    public function setEventCategoryId($eventCategoryId)
    {
        $this->eventCategoryId = $eventCategoryId;

        return $this;
    }

    /**
     * Get eventCategoryId
     *
     * @return integer 
     */
    public function getEventCategoryId()
    {
        return $this->eventCategoryId;
    }
    
    /**
     * Set supplierName
     *
     * @param string $supplierName
     * @return InventoryItem
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
     * Set email
     *
     * @param string $email
     * @return InventoryItem
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
     * @param string $notes
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
     * @return string 
     */
    public function getNotes()
    {
        return $this->notes;
    }
    
     /**
     * Set image
     *
     * @param string $image
     * @return InventoryItem
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
}
