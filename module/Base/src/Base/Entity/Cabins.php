<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cabins
 *
 * @ORM\Table(name="cabins", indexes={@ORM\Index(name="FK_cabins_cruises_id", columns={"cruise_id"})})
 * @ORM\Entity
 */
class Cabins extends Base\BaseEntity
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
     * @ORM\Column(name="deck_number", type="integer", nullable=false)
     */
    protected $deckNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    protected $isActive = '1';

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
     * Set deckNumber
     *
     * @param integer $deckNumber
     * @return Cabins
     */
    public function setDeckNumber($deckNumber)
    {
        $this->deckNumber = $deckNumber;

        return $this;
    }

    /**
     * Get deckNumber
     *
     * @return integer 
     */
    public function getDeckNumber()
    {
        return $this->deckNumber;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Cabins
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
     * @return Cabins
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
     * Set isActive
     *
     * @param boolean $isActive
     * @return Cabins
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set cruise
     *
     * @param \Base\Entity\Cruises $cruise
     * @return Cabins
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
