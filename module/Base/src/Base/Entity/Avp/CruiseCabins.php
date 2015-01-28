<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * CruiseCabins
 *
 * @ORM\Table(name="cruise_cabins")
 * @ORM\Entity
 */
class CruiseCabins extends \Base\Entity\Base\BaseEntity
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
     * @var integer
     *
     * @ORM\Column(name="deck_number", type="integer", nullable=false)
     */
    protected $deckNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="deck_name", type="string", length=255, nullable=true)
     */
    protected $deckName;

    /**
     * @var string
     *
     * @ORM\Column(name="deck_image_url", type="string", length=255, nullable=true)
     */
    protected $deckImageUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $price = '0.00';

    /**
     * @var integer
     *
     * @ORM\Column(name="in_stock", type="integer", nullable=false)
     */
    protected $inStock = '0';
    
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
     * Set cruiseId
     *
     * @param integer $cruiseId
     * @return CruiseCabins
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
     * Set deckNumber
     *
     * @param integer $deckNumber
     * @return CruiseCabins
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
     * Set deckName
     *
     * @param string $deckName
     * @return CruiseCabins
     */
    public function setDeckName($deckName)
    {
        $this->deckName = $deckName;

        return $this;
    }

    /**
     * Get deckName
     *
     * @return string 
     */
    public function getDeckName()
    {
        return $this->deckName;
    }

    /**
     * Set deckImageUrl
     *
     * @param string $deckImageUrl
     * @return CruiseCabins
     */
    public function setDeckImageUrl($deckImageUrl)
    {
        $this->deckImageUrl = $deckImageUrl;

        return $this;
    }

    /**
     * Get deckImageUrl
     *
     * @return string 
     */
    public function getDeckImageUrl()
    {
        return $this->deckImageUrl;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return CruiseCabins
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
     * @param string $price
     * @return CruiseCabins
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
     * Set inStock
     *
     * @param integer $inStock
     * @return CruiseCabins
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
