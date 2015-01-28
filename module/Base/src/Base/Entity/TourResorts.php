<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TourResorts
 *
 * @ORM\Table(name="tour_resorts")
 * @ORM\Entity
 */
class TourResorts extends Base\BaseEntity
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
     * @var \Base\Entity\Tours
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\Tours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tour_id", referencedColumnName="id")
     * })
     */
    private $tourId;

   
    
        /**
     * @var \Base\Entity\TourLocations
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\TourLocations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="location_id", referencedColumnName="id")
     * })
     */
    private $locationId;
    
       /**
     * @var \Base\Entity\Avp\Resorts
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\Avp\Resorts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resort_id", referencedColumnName="id")
     * })
     */
    protected $resortId;
    
      
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="from_date", type="date", nullable=true)
     */
    protected $fromDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="to_date", type="date", nullable=true)
     */
    protected $toDate;
    
    
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    protected $status = '1';
    
    
      /**
     * @var boolean
     *
     * @ORM\Column(name="is_deleted", type="boolean", nullable=true)
     */
    protected $isDeleted = '0';
    
    
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    protected $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime", nullable=true)
     */
    protected $modified;
    
    
     /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Set tourId
     *
     * @param integer $tourId
     * @return TourResorts
     */
    public function setTourId($tourId) {
        $this->tourId = $tourId;

        return $this;
    }

    /**
     * Get tourId
     *
     * @return integer 
     */
    public function getTourId() {
        return $this->tourId;
    }
    
    
    
    
    
    
    /**
     * Set locationId
     *
     * @param integer $locationId
     * @return TourResorts
     */
    public function setLocationId($locationId) {
        $this->locationId = $locationId;

        return $this;
    }

    /**
     * Get locationId
     *
     * @return integer 
     */
    public function getLocationId() {
        return $this->locationId;
    }
    
    
     /**
     * Set resortId
     *
     * @param integer $resortId
     * @return TourResorts
     */
    public function setResortId($resortId) {
        $this->resortId = $resortId;

        return $this;
    }

    /**
     * Get resortId
     *
     * @return integer 
     */
    public function getResortId() {
        return $this->resortId;
    }
  
    
   
     /**
     * Set fromDate
     *
     * @param \DateTime $fromDate
     * @return TourResorts
     */
    public function setFromDate($fromDate) {
        $this->fromDate = $fromDate;

        return $this;
    }

    /**
     * Get fromDate
     *
     * @return \DateTime 
     */
    public function getFromDate() {
        return $this->fromDate;
    }

    /**
     * Set toDate
     *
     * @param \DateTime $toDate
     * @return TourResorts
     */
    public function setToDate($toDate) {
        $this->toDate = $toDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getToDate() {
        return $this->toDate;
    }

   
     /**
     * Set isDeleted
     *
     * @param boolean $isDeleted
     * @return TourResorts
     */
    public function setIsDeleted($isDeleted) {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getIsDeleted() {
        return $this->isDeleted;
    }
    
    /**
     * Set status
     *
     * @param boolean $status
     * @return TourResorts
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus() {
        return $this->status;
    }
    
        
    
      /**
     * Set created
     *
     * @param \DateTime $created
     * @return TourResorts
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return TourResorts
     */
    public function setModified($modified) {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified() {
        return $this->modified;
    }


}
