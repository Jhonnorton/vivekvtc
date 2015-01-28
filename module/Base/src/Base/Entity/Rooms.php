<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rooms
 *
 * @ORM\Table(name="rooms", indexes={@ORM\Index(name="FK_rooms_resorts_id", columns={"resort_id"})})
 * @ORM\Entity
 */
class Rooms extends Base\BaseEntity
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
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=19, scale=2, nullable=false)
     */
    protected $price;

    /**
     * @var \Base\Entity\Resorts
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Resorts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resort_id", referencedColumnName="id")
     * })
     */
    protected $resort;



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
     * @return Rooms
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
     * @return Rooms
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
     * Set price
     *
     * @param float $price
     * @return Rooms
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set resort
     *
     * @param \Base\Entity\Resorts $resort
     * @return Rooms
     */
    public function setResort(\Base\Entity\Resorts $resort = null)
    {
        $this->resort = $resort;

        return $this;
    }

    /**
     * Get resort
     *
     * @return \Base\Entity\Resorts 
     */
    public function getResort()
    {
        return $this->resort;
    }
}
