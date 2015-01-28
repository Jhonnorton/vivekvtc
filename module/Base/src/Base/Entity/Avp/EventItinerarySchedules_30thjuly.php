<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventItinerarySchedules
 *
 * @ORM\Table(name="event_itinerary_schedules")
 * @ORM\Entity
 */
class EventItinerarySchedules
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
     * @var integer
     *
     * @ORM\Column(name="event_itinerary_id", type="integer", nullable=false)
     */
    private $eventItineraryId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="time", nullable=false)
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="text", nullable=false)
     */
    private $title;



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
     * Set eventItineraryId
     *
     * @param integer $eventItineraryId
     * @return EventItinerarySchedules
     */
    public function setEventItineraryId($eventItineraryId)
    {
        $this->eventItineraryId = $eventItineraryId;

        return $this;
    }

    /**
     * Get eventItineraryId
     *
     * @return integer 
     */
    public function getEventItineraryId()
    {
        return $this->eventItineraryId;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     * @return EventItinerarySchedules
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime 
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return EventItinerarySchedules
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
}
