<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Itinerary
 *
 * @ORM\Table(name="itinerary", indexes={@ORM\Index(name="FK_itinerary_cruises_id", columns={"cruise_id"})})
 * @ORM\Entity
 */
class Itinerary extends Base\BaseEntity
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
     * @ORM\Column(name="day", type="integer", nullable=false)
     */
    protected $day;

    /**
     * @var string
     *
     * @ORM\Column(name="port_location", type="string", length=128, nullable=false)
     */
    protected $portLocation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="arrival_time", type="time", nullable=false)
     */
    protected $arrivalTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="departure_time", type="time", nullable=false)
     */
    protected $departureTime;

    /**
     * @var string
     *
     * @ORM\Column(name="activity", type="text", nullable=true)
     */
    protected $activity;

    /**
     * @var \Base\Entity\Cruises
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Cruises")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cruise_id", referencedColumnName="id")
     * })
     */
    protected $cruise;



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
     * Set day
     *
     * @param integer $day
     * @return Itinerary
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return integer 
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set portLocation
     *
     * @param string $portLocation
     * @return Itinerary
     */
    public function setPortLocation($portLocation)
    {
        $this->portLocation = $portLocation;

        return $this;
    }

    /**
     * Get portLocation
     *
     * @return string 
     */
    public function getPortLocation()
    {
        return $this->portLocation;
    }

    /**
     * Set arrivalTime
     *
     * @param \DateTime $arrivalTime
     * @return Itinerary
     */
    public function setArrivalTime($arrivalTime)
    {
        $this->arrivalTime = $arrivalTime;

        return $this;
    }

    /**
     * Get arrivalTime
     *
     * @return \DateTime 
     */
    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }

    /**
     * Set departureTime
     *
     * @param \DateTime $departureTime
     * @return Itinerary
     */
    public function setDepartureTime($departureTime)
    {
        $this->departureTime = $departureTime;

        return $this;
    }

    /**
     * Get departureTime
     *
     * @return \DateTime 
     */
    public function getDepartureTime()
    {
        return $this->departureTime;
    }

    /**
     * Set activity
     *
     * @param string $activity
     * @return Itinerary
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return string 
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set cruise
     *
     * @param \Base\Entity\Cruises $cruise
     * @return Itinerary
     */
    public function setCruise(\Base\Entity\Cruises $cruise = null)
    {
        $this->cruise = $cruise;

        return $this;
    }

    /**
     * Get cruise
     *
     * @return \Base\Entity\Cruises 
     */
    public function getCruise()
    {
        return $this->cruise;
    }
}
