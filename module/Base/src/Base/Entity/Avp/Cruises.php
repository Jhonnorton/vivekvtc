<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cruises
 *
 * @ORM\Table(name="cruises")
 * @ORM\Entity
 */
class Cruises extends \Base\Entity\Base\BaseEntity
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
     * @ORM\Column(name="overview", type="text", nullable=true)
     */
    protected $overview;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=50, nullable=true)
     */
    protected $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tour_start_date", type="datetime", nullable=true)
     */
    protected $tourStartDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tour_end_date", type="datetime", nullable=true)
     */
    protected $tourEndDate;

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
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    protected $status = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added_on", type="datetime", nullable=true)
     */
    protected $addedOn;

    /**
     * @var integer
     *
     * @ORM\Column(name="parish_id", type="integer", nullable=true)
     */
    protected $parishId;

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=true)
     */
    protected $categoryId;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating_id", type="integer", nullable=true)
     */
    protected $ratingId;

    /**
     * @var integer
     *
     * @ORM\Column(name="country_id", type="integer", nullable=true)
     */
    protected $countryId;
    
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
     * @return Cruises
     */
    public function setUserId($userId) {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Cruises
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
     * @return Cruises
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
     * @return Cruises
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
     * Set image
     *
     * @param string $image
     * @return Cruises
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
     * Set tourStartDate
     *
     * @param \DateTime $tourStartDate
     * @return Cruises
     */
    public function setTourStartDate($tourStartDate)
    {
        $this->tourStartDate = $tourStartDate;

        return $this;
    }

    /**
     * Get tourStartDate
     *
     * @return \DateTime 
     */
    public function getTourStartDate()
    {
        return $this->tourStartDate;
    }

    /**
     * Set tourEndDate
     *
     * @param \DateTime $tourEndDate
     * @return Cruises
     */
    public function setTourEndDate($tourEndDate)
    {
        $this->tourEndDate = $tourEndDate;

        return $this;
    }

    /**
     * Get tourEndDate
     *
     * @return \DateTime 
     */
    public function getTourEndDate()
    {
        return $this->tourEndDate;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     * @return Cruises
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
     * @return Cruises
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
     * @return Cruises
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
     * Set status
     *
     * @param boolean $status
     * @return Cruises
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set addedOn
     *
     * @param \DateTime $addedOn
     * @return Cruises
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
     * Set parishId
     *
     * @param integer $parishId
     * @return Cruises
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
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Cruises
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
     * Set ratingId
     *
     * @param integer $ratingId
     * @return Cruises
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
     * Set countryId
     *
     * @param integer $countryId
     * @return Cruises
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
