<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InventoryPromo
 *
 * @ORM\Table(name="inventory_promo", uniqueConstraints={@ORM\UniqueConstraint(name="promo_code", columns={"promo_code"})})
 * @ORM\Entity
 */
class InventoryPromo extends Base\BaseEntity
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
     * @var string
     *
     * @ORM\Column(name="promo_names", type="string", length=64, nullable=true)
     */
    private $promoNames;

    /**
     * @var integer
     *
     * @ORM\Column(name="linke_to", type="integer", nullable=false)
     */
    private $linkedTo = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=true)
     */
    private $isActive = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_from", type="date", nullable=true)
     */
    private $dateFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_to", type="date", nullable=true)
     */
    private $dateTo;

    /**
     * @var string
     *
     * @ORM\Column(name="discount", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $discount = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="promo_code", type="string", length=32, nullable=true)
     */
    private $promoCode;

    /**
     * @var integer
     *
     * @ORM\Column(name="discount_type", type="integer", nullable=false)
     */
    private $discountType = '0';

    
     /**
     * @var integer
     *
     * @ORM\Column(name="number_available", type="integer", nullable=true)
     */
    private $numberAvailable;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;
    
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="date", nullable=true)
     */
    private $created;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="date", nullable=true)
     */
    private $updated;
    
    
     /**
     * @var integer
     *
     * @ORM\Column(name="promo_type", type="integer", nullable=false)
     */
    private $promoType='1';
    
     /**
     * @var integer
     *
     * @ORM\Column(name="validity", type="integer", nullable=false)
     */
    private $validity='1';
    
    
    
   
    
    
    
    
    /**
     * Set validity
     *
     * @param integer $validity
     * @return InventoryPromo
     */
    public function setvalidity($validity)
    {
        $this->validity = $validity;

        return $this;
    }

    /**
     * Get numberAvailable
     *
     * @return integer 
     */
    public function getvalidity()
    {
        return $this->validity;
    }
    
    
    
       
    /**
     * Set promoType
     *
     * @param integer $promoType
     * @return InventoryPromo
     */
    public function setpromoType($promoType)
    {
        $this->promoType = $promoType;

        return $this;
    }

    /**
     * Get numberAvailable
     *
     * @return integer 
     */
    public function getpromoType()
    {
        return $this->promoType;
    }
    
    
    
    
    
    /**
     * Set numberAvailable
     *
     * @param integer $numberAvailable
     * @return InventoryPromo
     */
    public function setNumberAvailable($numberAvailable)
    {
        $this->numberAvailable = $numberAvailable;

        return $this;
    }

    /**
     * Get numberAvailable
     *
     * @return integer 
     */
    public function getNumberAvailable()
    {
        return $this->numberAvailable;
    }
    
    
    
    
    
    
    
    
    /**
     * Set created
     * 
     * @param \DateTime $created
     * @return InventoryPromo
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }
    
     /**
     * Get created
     *
     * @return \DateTime  
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Get updated
     *
     * @param \DateTime $updated
     * @return InventoryPromo 
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
        return $this;
    }
    
    /**
     * Get updated
     *
     * @return \DateTime  
     */
    public function getUpdated()
    {
        return $this->updated;
    }
    
    
       
    
    
    
     /**
     * Set email
     *
     * @param string $email
     * @return InventoryPromo
     */
    public function setemail($email)
    {
        $this->email= $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getemail()
    {
        return $this->email;
    }
    
    
    
    
    
    


    /**
     * Set name
     *
     * @param string $name
     * @return InventoryPromo
     */
    public function setname($name)
    {
        $this->name= $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getname()
    {
        return $this->name;
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
     * Set promoNames
     *
     * @param string $promoNames
     * @return InventoryPromo
     */
    public function setPromoNames($promoNames)
    {
        $this->promoNames = $promoNames;

        return $this;
    }

    /**
     * Get promoNames
     *
     * @return string 
     */
    public function getPromoNames()
    {
        return $this->promoNames;
    }

    /**
     * Set linkeTo
     *
     * @param integer $linkedTo
     * @return InventoryPromo
     */
    public function setLinkedTo($linkedTo)
    {
        $this->linkedTo = $linkedTo;

        return $this;
    }

    /**
     * Get linkedTo
     *
     * @return integer 
     */
    public function getLinkedTo()
    {
        return $this->linkedTo;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return InventoryPromo
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
     * Set dateFrom
     *
     * @param \DateTime $dateFrom
     * @return InventoryPromo
     */
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    /**
     * Get dateFrom
     *
     * @return \DateTime 
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * Set dateTo
     *
     * @param \DateTime $dateTo
     * @return InventoryPromo
     */
    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    /**
     * Get dateTo
     *
     * @return \DateTime 
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * Set discount
     *
     * @param string $discount
     * @return InventoryPromo
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return string 
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return InventoryPromo
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
     * Set description
     *
     * @param string $description
     * @return InventoryPromo
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
     * Set promoCode
     *
     * @param string $promoCode
     * @return InventoryPromo
     */
    public function setPromoCode($promoCode)
    {
        $this->promoCode = $promoCode;

        return $this;
    }

    /**
     * Get promoCode
     *
     * @return string 
     */
    public function getPromoCode()
    {
        return $this->promoCode;
    }

    /**
     * Set discountType
     *
     * @param integer $discountType
     * @return InventoryPromo
     */
    public function setDiscountType($discountType)
    {
        $this->discountType = $discountType;

        return $this;
    }

    /**
     * Get discountType
     *
     * @return integer 
     */
    public function getDiscountType()
    {
        return $this->discountType;
    }
}
