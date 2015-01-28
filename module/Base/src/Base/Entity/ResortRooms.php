<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ResortRooms
 *
 * @ORM\Table(name="resort_rooms")
 * @ORM\Entity
 */
class ResortRooms extends \Base\Entity\Base\BaseEntity
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
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="resort_id", type="integer", nullable=false)
     */
    protected $resortId;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=0, nullable=false)
     */
    protected $price = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=50, nullable=true)
     */
    protected $image;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=255, nullable=true)
     */
    protected $metaTitle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_updated", type="datetime", nullable=true)
     */
    protected $lastUpdated;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="in_stock", type="integer", nullable=false)
     */
    protected $inStock = '0';
    
     /**
     * @var integer
     *
     * @ORM\OneToMany(targetEntity="Base\Entity\InventoryHotels", mappedBy="roomId")
     */
    protected $inventory;
    
    public function __construct() {
        $this->inventory = new ArrayCollection();
    }

    public function getInventory() {
        return $this->inventory;
      }

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
     * Set title
     *
     * @param string $title
     * @return ResortRooms
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
     * @return ResortRooms
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
     * Set resortId
     *
     * @param integer $resortId
     * @return ResortRooms
     */
    public function setResortId($resortId)
    {
        $this->resortId = $resortId;

        return $this;
    }

    /**
     * Get resortId
     *
     * @return integer 
     */
    public function getResortId()
    {
        return $this->resortId;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return ResortRooms
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return ResortRooms
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     * @return ResortRooms
     */
    public function setMetaTitle($metaTitle)
    {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string 
     */
    public function getMetaTitle()
    {
        return $this->metaTitle;
    }

    /**
     * Set lastUpdated
     *
     * @param \DateTime $lastUpdated
     * @return ResortRooms
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
    
    /**
     * Set inStock
     *
     * @param integer $inStock
     * @return ResortRooms
     */
    public function setInStock($inStock)
    {
        $this->inStock = $inStock;

        return $this;
    }

    /**
     * Get inStock
     *
     * @return integer 
     */
    public function getInStock()
    {
        return $this->inStock;
    }
}
