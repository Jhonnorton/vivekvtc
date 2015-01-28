<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * CruiseItineraries
 *
 * @ORM\Table(name="cruise_itineraries")
 * @ORM\Entity
 */
class CruiseItineraries
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
     * @ORM\Column(name="cruise_id", type="integer", nullable=false)
     */
    private $cruiseId;

    /**
     * @var string
     *
     * @ORM\Column(name="day", type="string", length=100, nullable=true)
     */
    private $day;

    /**
     * @var string
     *
     * @ORM\Column(name="port", type="string", length=255, nullable=true)
     */
    private $port;

    /**
     * @var string
     *
     * @ORM\Column(name="arrive", type="string", length=50, nullable=true)
     */
    private $arrive;

    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=50, nullable=true)
     */
    private $depart;

    /**
     * @var string
     *
     * @ORM\Column(name="activity", type="string", length=255, nullable=true)
     */
    private $activity;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_updated", type="datetime", nullable=true)
     */
    private $lastUpdated;



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
     * Set cruiseId
     *
     * @param integer $cruiseId
     * @return CruiseItineraries
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
     * Set day
     *
     * @param string $day
     * @return CruiseItineraries
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return string 
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set port
     *
     * @param string $port
     * @return CruiseItineraries
     */
    public function setPort($port)
    {
        $this->port = $port;

        return $this;
    }

    /**
     * Get port
     *
     * @return string 
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * Set arrive
     *
     * @param string $arrive
     * @return CruiseItineraries
     */
    public function setArrive($arrive)
    {
        $this->arrive = $arrive;

        return $this;
    }

    /**
     * Get arrive
     *
     * @return string 
     */
    public function getArrive()
    {
        return $this->arrive;
    }

    /**
     * Set depart
     *
     * @param string $depart
     * @return CruiseItineraries
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;

        return $this;
    }

    /**
     * Get depart
     *
     * @return string 
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * Set activity
     *
     * @param string $activity
     * @return CruiseItineraries
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
     * Set lastUpdated
     *
     * @param \DateTime $lastUpdated
     * @return CruiseItineraries
     */
    public function setLastUpdated($lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }

    /**
     * Get lastUpdated
     *
     * @return \DateTime 
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }
}
