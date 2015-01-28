<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TourLocations
 *
 * @ORM\Table(name="tour_locations")
 * @ORM\Entity
 */
class TourLocations extends Base\BaseEntity
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
     * @var \Base\Entity\Countries
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\Countries")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * })
     */
    private $countryId;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=128, nullable=true)
     */
    protected $city;

   
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
     * @return TourLocations
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
     * Set countryId
     *
     * @param integer $countryId
     * @return TourLocations
     */
    public function setCountryId($countryId) {
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * Get countryId
     *
     * @return integer 
     */
    public function getCountryId() {
        return $this->countryId;
    }
    
  
    /**
     * Set city
     *
     * @param string $city
     * @return TourLocations
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
     * Set fromDate
     *
     * @param \DateTime $fromDate
     * @return TourLocations
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
     * @return TourLocations
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
     * @return TourLocations
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
     * @return TourLocations
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
     * @return TourLocations
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
     * @return TourLocations
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
