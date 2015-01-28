<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ports
 *
 * @ORM\Table(name="ports", indexes={@ORM\Index(name="FK_ports_cruises_id", columns={"cruise_id"})})
 * @ORM\Entity
 */
class Ports extends Base\BaseEntity
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=true)
     */
    protected $name;

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
     * @ORM\Column(name="do_not_miss", type="text", nullable=true)
     */
    protected $doNotMiss;

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
     * Set name
     *
     * @param string $name
     * @return Ports
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Ports
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
     * @return Ports
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
     * Set doNotMiss
     *
     * @param string $doNotMiss
     * @return Ports
     */
    public function setDoNotMiss($doNotMiss)
    {
        $this->doNotMiss = $doNotMiss;

        return $this;
    }

    /**
     * Get doNotMiss
     *
     * @return string 
     */
    public function getDoNotMiss()
    {
        return $this->doNotMiss;
    }

    /**
     * Set cruise
     *
     * @param \Base\Entity\Cruises $cruise
     * @return Ports
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
