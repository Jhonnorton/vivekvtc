<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resorts
 *
 * @ORM\Table(name="resorts", indexes={@ORM\Index(name="FK_resorts_countries_id", columns={"country_id"})})
 * @ORM\Entity
 */
class Resorts extends Base\BaseEntity
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
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var \Base\Entity\Countries
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Countries")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * })
     */
    protected $country;



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
     * @return Resorts
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
     * @return Resorts
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
     * Set country
     *
     * @param \Base\Entity\Countries $country
     * @return Resorts
     */
    public function setCountry(\Base\Entity\Countries $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Base\Entity\Countries 
     */
    public function getCountry()
    {
        return $this->country;
    }
}
