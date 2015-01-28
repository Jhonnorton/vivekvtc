<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InventoryLeadRooms
 *
 * @ORM\Table(name="inventory_lead_rooms")
 * @ORM\Entity
 */
class InventoryLeadRooms extends Base\BaseEntity {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var \Base\Entity\InventoryLeads
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\InventoryLeads")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inventory_lead_id", referencedColumnName="id")
     * })
     */
    protected $inventoryLeadId;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    protected $type;

  

    /**
     * @var \Base\Entity\Avp\ResortRooms
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\Avp\ResortRooms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resort_room_id", referencedColumnName="id")
     * })
     */
    protected $resortRoomId;

    /**
     * @var \Base\Entity\Avp\EventRooms
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\Avp\EventRooms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event_room_id", referencedColumnName="id")
     * })
     */
    protected $eventRoomId;

    /**
     * @var \Base\Entity\Avp\CruiseCabins
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\Avp\CruiseCabins")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cruise_cabin_id", referencedColumnName="id")
     * })
     */
    protected $cruiseCabinId;
    
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="cost", type="decimal", precision=10, scale=2, nullable=true)
     */
    protected $cost = '0.00';
    /**
     * @var string
     *
     * @ORM\Column(name="net_cost", type="decimal", precision=10, scale=2, nullable=true)
     */
    protected $netCost = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="price_per", type="integer", nullable=true)
     */
    protected $pricePer=1;

   
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;
    
    
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date", nullable=true)
     */
    protected $createdAt;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set inventoryLeadId
     *
     * @param integer $inventoryLeadId
     * @return InventoryLeadRooms
     */
    public function setInventoryLeadId($inventoryLeadId) {
        $this->inventoryLeadId = $inventoryLeadId;

        return $this;
    }

    /**
     * Get inventoryLeadId
     *
     * @return integer 
     */
    public function getInventoryLeadId() {
        return $this->inventoryLeadId;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return InventoryLeadRooms
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType() {
        return $this->type;
    }

   
    /**
     * Set resortRoomId
     *
     * @param integer $resortRoomId
     * @return \Base\Entity\Avp\ResortRooms $resortRoomId
     */
    public function setResortRoomId(\Base\Entity\Avp\ResortRooms $resortRoomId) {
        $this->resortRoomId = $resortRoomId;

        return $this;
    }

    /**
     * Get resortRoomId
     *
     * @return \Base\Entity\Avp\ResortRooms $resortRoomId 
     */
    public function getResortRoomId() {
        return $this->resortRoomId;
    }

    /**
     * Set eventRoomId
     *
     * @param integer $eventRoomId
     * @return InventoryLeadRooms
     */
    public function setEventRoomId($eventRoomId) {
        $this->eventRoomId = $eventRoomId;

        return $this;
    }

    /**
     * Get eventRoomId
     *
     * @return integer 
     */
    public function getEventRoomId() {
        return $this->eventRoomId;
    }

    /**
     * Set cruiseCabinId
     *
     * @param integer $cruiseCabinId
     * @return InventoryLeadRooms
     */
    public function setCruiseCabinId($cruiseCabinId) {
        $this->cruiseCabinId = $cruiseCabinId;

        return $this;
    }

    /**
     * Get cruiseCabinId
     *
     * @return integer 
     */
    public function getCruiseCabinId() {
        return $this->cruiseCabinId;
    }

    
    
    
    /**
     * Set cost
     *
     * @param string $cost
     * @return InventoryLeadRooms
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return string 
     */
    public function getCost()
    {
        return $this->cost;
    }
    /**
     * Set netCost
     *
     * @param string $netCost
     * @return InventoryLeadRooms
     */
    public function setNetCost($netCost)
    {
        $this->netCost = $netCost;

        return $this;
    }

    /**
     * Get netCost
     *
     * @return string 
     */
    public function getNetCost()
    {
        return $this->netCost;
    }

    
 /**
     * Set description
     *
     * @param string $description
     * @return InventoryLeadRooms
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return InventoryLeadRooms
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }
    
    
    /**
     * Set pricePer
     *
     * @param integer $pricePer
     * @return InventoryLeadRooms
     */
    public function setPricePer($pricePer)
    {
        $this->pricePer = $pricePer;

        return $this;
    }

    /**
     * Get pricePer
     *
     * @return integer 
     */
    public function getPricePer()
    {
        return $this->pricePer;
    }

    
    
    
    /**
     * Set image
     *
     * @param string $image
     * @return InventoryLeadRooms
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
