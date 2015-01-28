<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InventoryLeads
 *
 * @ORM\Table(name="inventory_leads")
 * @ORM\Entity
 */
class InventoryLeads extends Base\BaseEntity {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var \Base\Entity\Leads
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\Leads")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lead_id", referencedColumnName="id")
     * })
     */
    protected $leadId;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    protected $type;

  

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
     * @var \Base\Entity\Avp\Events
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\Avp\Events")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event_id", referencedColumnName="id")
     * })
     */
    protected $eventId;

    /**
     * @var \Base\Entity\Avp\Cruises
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\Avp\Cruises")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cruise_id", referencedColumnName="id")
     * })
     */
    protected $cruiseId;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", nullable=true)
     */
    protected $notes;

    /**
     * @var string
     *
     * @ORM\Column(name="accomodation_details", type="text", nullable=true)
     */
    protected $accomodationDetails;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="travel_from", type="date", nullable=true)
     */
    protected $travelFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="travel_to", type="date", nullable=true)
     */
    protected $travelTo;

    /**
     * @var integer
     *
     * @ORM\Column(name="room_required", type="integer", nullable=true)
     */
    protected $roomRequired = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="no_of_persons", type="integer", nullable=true)
     */
    protected $noOfPersons = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date", nullable=true)
     */
    protected $createdAt;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="come_from", type="integer", nullable=true)
     */
    protected $comeFrom;

/**
     * @var integer
     *
     * @ORM\Column(name="is_reserved", type="integer", nullable=true)
     */
    protected $isReserved = '0';


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set leadId
     *
     * @param integer $leadId
     * @return InventoryLeads
     */
    public function setLeadId($leadId) {
        $this->leadId = $leadId;

        return $this;
    }

    /**
     * Get leadId
     *
     * @return integer 
     */
    public function getLeadId() {
        return $this->leadId;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return InventoryLeads
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
     * Set resortId
     *
     * @param integer $resortId
     * @return InventoryLeads
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
     * Set eventId
     *
     * @param integer $eventId
     * @return InventoryLeads
     */
    public function setEventId($eventId) {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return integer 
     */
    public function getEventId() {
        return $this->eventId;
    }

    /**
     * Set cruiseId
     *
     * @param integer $cruiseId
     * @return InventoryLeads
     */
    public function setCruiseId($cruiseId) {
        $this->cruiseId = $cruiseId;

        return $this;
    }

    /**
     * Get cruiseId
     *
     * @return integer 
     */
    public function getCruiseId() {
        return $this->cruiseId;
    }

    /**
     * Set notes
     *
     * @param string $notes
     * @return InventoryLeads
     */
    public function setNotes($notes) {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string 
     */
    public function getNotes() {
        return $this->notes;
    }

    /**
     * Set accomodationDetails
     *
     * @param string $accomodationDetails
     * @return InventoryLeads
     */
    public function setAccomodationDetails($accomodationDetails) {
        $this->accomodationDetails = $accomodationDetails;

        return $this;
    }

    /**
     * Get accomodationDetails
     *
     * @return string 
     */
    public function getAccomodationDetails() {
        return $this->accomodationDetails;
    }

    /**
     * Set travelFrom
     *
     * @param \DateTime $travelFrom
     * @return InventoryLeads
     */
    public function setTravelFrom($travelFrom) {
        $this->travelFrom = $travelFrom;

        return $this;
    }

    /**
     * Get travelFrom
     *
     * @return \DateTime 
     */
    public function getTravelFrom() {
        return $this->travelFrom;
    }

    /**
     * Set travelTo
     *
     * @param \DateTime $travelTo
     * @return InventoryLeads
     */
    public function setTravelTo($travelTo) {
        $this->travelTo = $travelTo;

        return $this;
    }

    /**
     * Get travelTo
     *
     * @return \DateTime 
     */
    public function getTravelTo() {
        return $this->travelTo;
    }

    /**
     * Set roomRequired
     *
     * @param integer $roomRequired
     * @return InventoryLeads
     */
    public function setRoomRequired($roomRequired) {
        $this->roomRequired = $roomRequired;

        return $this;
    }

    /**
     * Get roomRequired
     *
     * @return integer 
     */
    public function getRoomRequired() {
        return $this->roomRequired;
    }

    /**
     * Set noOfDays
     *
     * @param integer $noOfPersons
     * @return InventoryLeads
     */
    public function setNoOfPersons($noOfPersons) {
        $this->noOfPersons = $noOfPersons;

        return $this;
    }

    /**
     * Get noOfPersons
     *
     * @return integer 
     */
    public function getNoOfPersons() {
        return $this->noOfPersons;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return InventoryLeads
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
     * Set isReserved
     *
     * @param integer $isReserved
     * @return InventoryLeads
     */
    public function setIsReserved($isReserved) {
        $this->isReserved = $isReserved;

        return $this;
    }

    /**
     * Get isReserved
     *
     * @return integer 
     */
    public function getIsReserved() {
        return $this->isReserved;
    }
 /**
     * Set comeFrom
     *
     * @param integer $comeFrom
     * @return InventoryLeads
     */
    public function setComeFrom($comeFrom) {
        $this->comeFrom = $comeFrom;

        return $this;
    }

    /**
     * Get comeFrom
     *
     * @return integer 
     */
    public function getComeFrom() {
        return $this->comeFrom;
    }

}
