<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resorts
 *
 * @ORM\Table(name="resorts")
 * @ORM\Entity
 */
class Resorts extends \Base\Entity\Base\BaseEntity
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
     * @var \Base\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    
    private $userId;
    
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(name="page_heading", type="string", length=255, nullable=true)
     */
    protected $pageHeading;

    /**
     * @var string
     *
     * @ORM\Column(name="overview", type="text", nullable=false)
     */
    protected $overview;

    /**
     * @var string
     *
     * @ORM\Column(name="amenities", type="text", nullable=true)
     */
    protected $amenities;

    /**
     * @var string
     *
     * @ORM\Column(name="entertainment", type="text", nullable=true)
     */
    protected $entertainment;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    protected $image;

    /**
     * @var boolean
     *
     * @ORM\Column(name="order_num", type="boolean", nullable=true)
     */
    protected $orderNum;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_featured", type="boolean", nullable=true)
     */
    protected $isFeatured = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=255, nullable=true)
     */
    protected $metaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="text", nullable=true)
     */
    protected $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keywords", type="string", length=255, nullable=true)
     */
    protected $metaKeywords;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added_on", type="datetime", nullable=true)
     */
    protected $addedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    protected $status = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=true)
     */
    protected $categoryId;

    /**
     * @var integer
     *
     * @ORM\Column(name="country_id", type="integer", nullable=true)
     */
    protected $countryId;

    /**
     * @var string
     *
     * @ORM\Column(name="popover_content", type="text", nullable=true)
     */
    protected $popoverContent;

    /**
     * @var string
     *
     * @ORM\Column(name="popover_title", type="string", length=64, nullable=true)
     */
    protected $popoverTitle;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating_id", type="integer", nullable=true)
     */
    protected $ratingId;

    /**
     * @var integer
     *
     * @ORM\Column(name="parish_id", type="integer", nullable=true)
     */
    protected $parishId;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    protected $price;


    /**
     * @var integer
     *
     * @ORM\Column(name="added_to_vp", type="integer", nullable=true)
     */
    protected $addedToVp;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_tour", type="integer", nullable=true)
     */
    protected $isTour;
    
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
     * Set userId
     *
     * @param integer $userId
     * @return Resorts
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }
    
    /**
     * Set title
     *
     * @param string $title
     * @return Resorts
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
     * Set pageHeading
     *
     * @param string $pageHeading
     * @return Resorts
     */
    public function setPageHeading($pageHeading)
    {
        $this->pageHeading = $pageHeading;

        return $this;
    }

    /**
     * Get pageHeading
     *
     * @return string 
     */
    public function getPageHeading()
    {
        return $this->pageHeading;
    }

    /**
     * Set overview
     *
     * @param string $overview
     * @return Resorts
     */
    public function setOverview($overview)
    {
        $this->overview = $overview;

        return $this;
    }

    /**
     * Get overview
     *
     * @return string 
     */
    public function getOverview()
    {
        return $this->overview;
    }

    /**
     * Set amenities
     *
     * @param string $amenities
     * @return Resorts
     */
    public function setAmenities($amenities)
    {
        $this->amenities = $amenities;

        return $this;
    }

    /**
     * Get amenities
     *
     * @return string 
     */
    public function getAmenities()
    {
        return $this->amenities;
    }

    /**
     * Set entertainment
     *
     * @param string $entertainment
     * @return Resorts
     */
    public function setEntertainment($entertainment)
    {
        $this->entertainment = $entertainment;

        return $this;
    }

    /**
     * Get entertainment
     *
     * @return string 
     */
    public function getEntertainment()
    {
        return $this->entertainment;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Resorts
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
     * Set orderNum
     *
     * @param boolean $orderNum
     * @return Resorts
     */
    public function setOrderNum($orderNum)
    {
        $this->orderNum = $orderNum;

        return $this;
    }

    /**
     * Get orderNum
     *
     * @return boolean 
     */
    public function getOrderNum()
    {
        return $this->orderNum;
    }

    /**
     * Set isFeatured
     *
     * @param boolean $isFeatured
     * @return Resorts
     */
    public function setIsFeatured($isFeatured)
    {
        $this->isFeatured = $isFeatured;

        return $this;
    }

    /**
     * Get isFeatured
     *
     * @return boolean 
     */
    public function getIsFeatured()
    {
        return $this->isFeatured;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     * @return Resorts
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
     * Set metaDescription
     *
     * @param string $metaDescription
     * @return Resorts
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string 
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set metaKeywords
     *
     * @param string $metaKeywords
     * @return Resorts
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * Get metaKeywords
     *
     * @return string 
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * Set addedOn
     *
     * @param \DateTime $addedOn
     * @return Resorts
     */
    public function setAddedOn($addedOn)
    {
        $this->addedOn = $addedOn;

        return $this;
    }

    /**
     * Get addedOn
     *
     * @return \DateTime 
     */
    public function getAddedOn()
    {
        return $this->addedOn;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Resorts
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Resorts
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set countryId
     *
     * @param integer $countryId
     * @return Resorts
     */
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * Get countryId
     *
     * @return integer 
     */
    public function getCountryId()
    {
        return $this->countryId;
    }

    /**
     * Set popoverContent
     *
     * @param string $popoverContent
     * @return Resorts
     */
    public function setPopoverContent($popoverContent)
    {
        $this->popoverContent = $popoverContent;

        return $this;
    }

    /**
     * Get popoverContent
     *
     * @return string 
     */
    public function getPopoverContent()
    {
        return $this->popoverContent;
    }

    /**
     * Set popoverTitle
     *
     * @param string $popoverTitle
     * @return Resorts
     */
    public function setPopoverTitle($popoverTitle)
    {
        $this->popoverTitle = $popoverTitle;

        return $this;
    }

    /**
     * Get popoverTitle
     *
     * @return string 
     */
    public function getPopoverTitle()
    {
        return $this->popoverTitle;
    }

    /**
     * Set ratingId
     *
     * @param integer $ratingId
     * @return Resorts
     */
    public function setRatingId($ratingId)
    {
        $this->ratingId = $ratingId;

        return $this;
    }

    /**
     * Get ratingId
     *
     * @return integer 
     */
    public function getRatingId()
    {
        return $this->ratingId;
    }

    /**
     * Set parishId
     *
     * @param integer $parishId
     * @return Resorts
     */
    public function setParishId($parishId)
    {
        $this->parishId = $parishId;

        return $this;
    }

    /**
     * Get parishId
     *
     * @return integer 
     */
    public function getParishId()
    {
        return $this->parishId;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Resorts
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }


/**
     * Set addedToVp
     *
     * @param integer $addedToVp
     * @return Resorts
     */
    public function setAddedToVp($addedToVp) {
        $this->addedToVp = $addedToVp;

        return $this;
    }

    /**
     * Get ratingId
     *
     * @return integer 
     */
    public function getAddedToVp() {
        return $this->addedToVp;
    }
            
            
     /**
     * Set isTour
     *
     * @param integer $isTour
     * @return Resorts
     */
    public function setIsTour($isTour) {
        $this->isTour = $isTour;

        return $this;
    }

    /**
     * Get isTour
     *
     * @return integer 
     */
    public function getIsTour() {
        return $this->isTour;
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
