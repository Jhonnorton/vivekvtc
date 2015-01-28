<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InventoryLeadAddOns
 *
 * @ORM\Table(name="inventory_lead_addons")
 * @ORM\Entity
 */
class InventoryLeadAddOns extends Base\BaseEntity {

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
     * @var \Base\Entity\InventoryExcursion
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\InventoryExcursion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="excursion_id", referencedColumnName="id")
     * })
     */
    private $excursion;

       /**
     * @var \Base\Entity\InventoryItem
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\InventoryItem")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     * })
     */
    private $item;


    /**
     * @var \Base\Entity\InventoryTransfer
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\InventoryTransfer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="transfer_id", referencedColumnName="id")
     * })
     */
    private $transfer;
    
    
  
   
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
     * @return InventoryLeadAddOns
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
     * Set $excursion
     *
     * @param integer $excursion
     * @return InventoryLeadAddOns
     */
    public function setExcursion($excursion) {
        $this->excursion = $excursion;

        return $this;
    }

    /**
     * Get excursion
     *
     * @return integer 
     */
    public function getExcursion() {
        return $this->excursion;
    }

    
        /**
     * Set $item
     *
     * @param integer $item
     * @return InventoryLeadAddOns
     */
    public function setItem($item) {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return integer 
     */
    public function getItem() {
        return $this->item;
    }
    
    
    
      /**
     * Set transfer
     *
     * @param integer $transfer
     * @return InventoryLeadAddOns
     */
    public function setTransfer($item) {
        $this->transfer = $item;

        return $this;
    }

    /**
     * Get transfer
     *
     * @return integer 
     */
    public function getTransfer() {
        return $this->transfer;
    }
    
    
       
    
    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return InventoryLeadAddOns
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

}
