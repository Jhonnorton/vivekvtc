<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InventoryDeposits
 *
 * @ORM\Table(name="inventory_deposits")
 * @ORM\Entity
 */
class InventoryDeposits extends Base\BaseEntity
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
     * @ORM\Column(name="deposit_name", type="string", length=64, nullable=true)
     */
    private $depositName;

    /**
     * @var integer
     *
     * @ORM\Column(name="linked_to", type="integer", nullable=false)
     */
    private $linkedTo = '0';

    

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_from", type="datetime", nullable=true)
     */
    private $dateFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_to", type="datetime", nullable=true)
     */
    private $dateTo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime", nullable=true)
     */
    private $modified;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="event_id", type="string", nullable=true)
     */
    private $eventId;

    /**
     * @var string
     *
     * @ORM\Column(name="resort_id", type="string", nullable=true)
     */
    private $resortId;

    /**
     * @var integer
     *
     * @ORM\Column(name="cruise_id", type="string", nullable=false)
     */
    private $cruiseId;

    
     /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $amount = '0.00';
    
     /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    private $type = '0';
     /**
     * @var integer
     *
     * @ORM\Column(name="is_deleted", type="integer", nullable=false)
     */
    private $isDeleted = '0';

    
    
       
    /**
     * Set depositName
     *
     * @param integer $depositName
     * @return InventoryDeposits
     */
    public function setdepositName($depositName)
    {
        $this->depositName = $depositName;

        return $this;
    }

    /**
     * Get numberAvailable
     *
     * @return integer 
     */
    public function getdepositName()
    {
        return $this->depositName;
    }
    
    
    
    
    
    /**
     * Set linkedTo
     *
     * @param integer $linkedTo
     * @return InventoryDeposits
     */
    public function setlinkedTo($linkedTo)
    {
        $this->linkedTo = $linkedTo;

        return $this;
    }

    /**
     * Get linkedTo
     *
     * @return integer 
     */
    public function getlinkedTo()
    {
        return $this->linkedTo;
    }
    
    
    
    
    
    
    
    
    /**
     * Set created
     * 
     * @param \DateTime $created
     * @return InventoryDeposits
     */
    public function setcreated($created)
    {
        $this->created = $created;

        return $this;
    }
    
     /**
     * Get created
     *
     * @return \DateTime  
     */
    public function getcreated()
    {
        return $this->created;
    }

    /**
     * Get modified
     *
     * @param \DateTime $modified
     * @return InventoryDeposits 
     */
    public function setmodified($modified)
    {
        $this->modified = $modified;
        return $this;
    }
    
    /**
     * Get modified
     *
     * @return \DateTime  
     */
    public function getmodified()
    {
        return $this->modified;
    }
    
    
       
    
    
    
     /**
     * Set dateFrom
     *
     * @param \DateTime $dateFrom
     * @return InventoryDeposits
     */
    public function setdateFrom($dateFrom)
    {
        $this->dateFrom= $dateFrom;

        return $this;
    }

    /**
     * Get dateFrom
     *
     * @return \DateTime
     */
    public function getdateFrom()
    {
        return $this->dateFrom;
    }
    
     /**
     * Set dateTo
     *
     * @param \DateTime $dateFrom
     * @return InventoryDeposits
     */
    public function setdateTo($dateTo)
    {
        $this->dateTo= $dateTo;

        return $this;
    }

    /**
     * Get dateTo
     *
     * @return \DateTime
     */
    public function getdateTo()
    {
        return $this->dateTo;
    }
    
    
    
    
    
    


    /**
     * Set eventId
     *
     * @param string $eventId
     * @return InventoryDeposits
     */
    public function seteventId($eventId)
    {
        $this->eventId= $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return string 
     */
    public function geteventId()
    {
        return $this->eventId;
    }
    /**
     * Set resortId
     *
     * @param string $resortId
     * @return InventoryDeposits
     */
    public function setresortId($resortId)
    {
        $this->resortId= $resortId;

        return $this;
    }

    /**
     * Get resortId
     *
     * @return string 
     */
    public function getresortId()
    {
        return $this->resortId;
    }
    /**
     * Set cruiseId
     *
     * @param string $cruiseId
     * @return InventoryDeposits
     */
    public function setcruiseId($cruiseId)
    {
        $this->cruiseId= $cruiseId;

        return $this;
    }

    /**
     * Get cruiseId
     *
     * @return string 
     */
    public function getcruiseId()
    {
        return $this->cruiseId;
    }
    
   
    
    
    
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
     * Set type
     *
     * @param integer $type
     * @return InventoryDeposits
     */
    public function settype($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function gettype()
    {
        return $this->type;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     * @return InventoryDeposits
     */
    public function setamount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getamount()
    {
        return $this->amount;
    }
    /**
     * Set isDeleted
     *
     * @param integer $isDeleted
     * @return InventoryDeposits
     */
    public function setisDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get isDeleted
     *
     * @return integer 
     */
    public function getisDeleted()
    {
        return $this->isDeleted;
    }
}
