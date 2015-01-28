<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tours
 *
 * @ORM\Table(name="tours")
 * @ORM\Entity
 */
class Tours extends Base\BaseEntity
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
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="date", nullable=true)
     */
    protected $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="date", nullable=true)
     */
    protected $endDate;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="minimum_stay_days", type="integer", nullable=false)
     */
    protected $minimumStayDays;
    
    
     /**
     * @var integer
     *
     * @ORM\Column(name="is_signature", type="integer", nullable=true)
     */
    protected $isSignatured = 0;
    
    
     /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=true)
     */
    protected $categoryId;
    
      /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=100, nullable=true)
     */
    protected $image;
    
    
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
     * @ORM\Column(name="keyword", type="text", nullable=true)
     */
    protected $metaKeywords;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="itinerary_pdf", type="string", length=255, nullable=true)
     */
    protected $itineraryPdf;
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="country_id", type="string", length=255, nullable=true)
     */
    protected $countryId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    protected $status = '1';
    
    
      /**
     * @var boolean
     *
     * @ORM\Column(name="is_deleted", type="boolean", nullable=true)
     */
    protected $isDeleted = '0';
    
    
        /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    protected $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime", nullable=true)
     */
    protected $modified;
    
    
     /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }
    
    
    /**
     * Set title
     *
     * @param string $title
     * @return Tours
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }
    
     /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Tours
     */
    public function setStartDate($startDate) {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate() {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Tours
     */
    public function setEndDate($endDate) {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate() {
        return $this->endDate;
    }

    /**
     * Set minimumStayDays
     *
     * @param integer $minimumStayDays
     * @return Tours
     */
    public function setMinimumStayDays($minimumStayDays) {
        $this->minimumStayDays = $minimumStayDays;

        return $this;
    }

    /**
     * Get minimumStayDays
     *
     * @return integer 
     */
    public function getMinimumStayDays() {
        return $this->minimumStayDays;
    }
    
     /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Tours
     */
    public function setCategoryId($categoryId) {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer 
     */
    public function getCategoryId() {
        return $this->categoryId;
    }
    
    
     /**
     * Set isSignatured
     *
     * @param integer $isSignatured
     * @return Tours
     */
    public function setIsSignatured($isSignatured) {
        $this->isSignatured = $isSignatured;

        return $this;
    }

    /**
     * Get isSignatured
     *
     * @return integer 
     */
    public function getIsSignatured() {
        return $this->isSignatured;
    }
    
    
    /**
     * Set description
     *
     * @param string $description
     * @return Tours
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
     * Set image
     *
     * @param string $image
     * @return Tours
     */
    public function setImage($image) {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage() {
        return $this->image;
    }
    
    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     * @return Tours
     */
    public function setMetaTitle($metaTitle) {
        $this->metaTitle = $metaTitle;

        return $this;
    }

    /**
     * Get metaTitle
     *
     * @return string 
     */
    public function getMetaTitle() {
        return $this->metaTitle;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     * @return Tours
     */
    public function setMetaDescription($metaDescription) {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string 
     */
    public function getMetaDescription() {
        return $this->metaDescription;
    }

    /**
     * Set metaKeywords
     *
     * @param string $metaKeywords
     * @return Tours
     */
    public function setMetaKeywords($metaKeywords) {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * Get metaKeywords
     *
     * @return string 
     */
    public function getMetaKeywords() {
        return $this->metaKeywords;
    }
    
    
    /**
     * Set itineraryPdf
     *
     * @param string $itineraryPdf
     * @return Tours
     */
    public function setItineraryPdf($itineraryPdf) {
        $this->itineraryPdf = $itineraryPdf;

        return $this;
    }

    /**
     * Get itineraryPdf
     *
     * @return string 
     */
    public function getItineraryPdf() {
        return $this->itineraryPdf;
    }
    
     /**
     * Set countryId
     *
     * @param string $countryId
     * @return Tours
     */
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * Get countryId
     *
     * @return string 
     */
    public function getCountryId()
    {
        return $this->countryId;
    }
    
     /**
     * Set isDeleted
     *
     * @param boolean $isDeleted
     * @return Tours
     */
    public function setIsDeleted($isDeleted) {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getIsDeleted() {
        return $this->isDeleted;
    }
    
    /**
     * Set status
     *
     * @param boolean $status
     * @return Tours
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus() {
        return $this->status;
    }
    
    
    
    
    
    
    
    
    
    
    
    
      /**
     * Set created
     *
     * @param \DateTime $created
     * @return Tours
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return Tours
     */
    public function setModified($modified) {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified() {
        return $this->modified;
    }


}
