<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * CruisePorts
 *
 * @ORM\Table(name="cruise_ports")
 * @ORM\Entity
 */
class CruisePorts extends \Base\Entity\Base\BaseEntity
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
     * @ORM\Column(name="cruise_id", type="integer", nullable=false)
     */
    protected $cruiseId;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="things_to_do", type="text", nullable=true)
     */
    protected $thingsToDo;

    /**
     * @var string
     *
     * @ORM\Column(name="dont_miss", type="text", nullable=true)
     */
    protected $dontMiss;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_updated", type="datetime", nullable=true)
     */
    protected $lastUpdated;



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
     * @return CruisePorts
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
     * Set title
     *
     * @param string $title
     * @return CruisePorts
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

    /**
     * Set description
     *
     * @param string $description
     * @return CruisePorts
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
     * Set thingsToDo
     *
     * @param string $thingsToDo
     * @return CruisePorts
     */
    public function setThingsToDo($thingsToDo)
    {
        $this->thingsToDo = $thingsToDo;

        return $this;
    }

    /**
     * Get thingsToDo
     *
     * @return string 
     */
    public function getThingsToDo()
    {
        return $this->thingsToDo;
    }

    /**
     * Set dontMiss
     *
     * @param string $dontMiss
     * @return CruisePorts
     */
    public function setDontMiss($dontMiss)
    {
        $this->dontMiss = $dontMiss;

        return $this;
    }

    /**
     * Get dontMiss
     *
     * @return string 
     */
    public function getDontMiss()
    {
        return $this->dontMiss;
    }

    /**
     * Set lastUpdated
     *
     * @param \DateTime $lastUpdated
     * @return CruisePorts
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
