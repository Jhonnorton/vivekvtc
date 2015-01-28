<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventRooms
 *
 * @ORM\Table(name="event_rooms")
 * @ORM\Entity
 */
class EventRooms extends \Base\Entity\Base\BaseEntity
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
     * @var \Base\Entity\Avp\ResortRooms
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Avp\ResortRooms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     * })
     */
    
    protected $roomId;

    /**
     * @var integer
     *
     * @ORM\Column(name="event_id", type="integer", nullable=false)
     */
    protected $eventId;

    /**
     * @var float
     *
     * @ORM\Column(name="room_price", type="float", precision=10, scale=0, nullable=false)
     */
    protected $roomPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="room_price_cad", type="float", precision=10, scale=0, nullable=true)
     */
    protected $roomPriceCad;

    /**
     * @var string
     *
     * @ORM\Column(name="room_category", type="text", nullable=false)
     */
    protected $roomCategory;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added_on", type="datetime", nullable=false)
     */
    protected $addedOn;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    protected $status = '1';
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_deleted", type="boolean", nullable=false)
     */
    protected $isDeleted='0';



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
     * Set roomId
     *
     * @param integer $roomId
     * @return EventRooms
     */
    public function setRoomId($roomId)
    {
        $this->roomId = $roomId;

        return $this;
    }

    /**
     * Get roomId
     *
     * @return integer 
     */
    public function getRoomId()
    {
        return $this->roomId;
    }

    /**
     * Set eventId
     *
     * @param integer $eventId
     * @return EventRooms
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
     * Set roomPrice
     *
     * @param float $roomPrice
     * @return EventRooms
     */
    public function setRoomPrice($roomPrice)
    {
        $this->roomPrice = $roomPrice;

        return $this;
    }

    /**
     * Get roomPrice
     *
     * @return float 
     */
    public function getRoomPrice()
    {
        return $this->roomPrice;
    }

    /**
     * Set roomPriceCad
     *
     * @param float $roomPriceCad
     * @return EventRooms
     */
    public function setRoomPriceCad($roomPriceCad)
    {
        $this->roomPriceCad = $roomPriceCad;

        return $this;
    }

    /**
     * Get roomPriceCad
     *
     * @return float 
     */
    public function getRoomPriceCad()
    {
        return $this->roomPriceCad;
    }

    /**
     * Set roomCategory
     *
     * @param string $roomCategory
     * @return EventRooms
     */
    public function setRoomCategory($roomCategory)
    {
        $this->roomCategory = $roomCategory;

        return $this;
    }

    /**
     * Get roomCategory
     *
     * @return string 
     */
    public function getRoomCategory()
    {
        return $this->roomCategory;
    }

    /**
     * Set addedOn
     *
     * @param \DateTime $addedOn
     * @return EventRooms
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
     * Set status
     *
     * @param boolean $status
     * @return EventRooms
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }
    
     /**
     * Get isDeleted
     *
     * @return integer 
     */
    public function getIsDeleted()
    {
        return $this->isDeleted;
    }
    
    /**
     * Set isDeleted
     *
     * @param integer $isDeleted
     * @return Reservation
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }
}
