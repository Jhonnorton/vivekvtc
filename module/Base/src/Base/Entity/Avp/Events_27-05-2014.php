<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * Events
 *
 * @ORM\Table(name="events")
 * @ORM\Entity
 */
class Events extends \Base\Entity\Base\BaseEntity
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
     * @ORM\Column(name="resort_id", type="integer", nullable=false)
     */
    protected $resortId;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    protected $userId;

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
     * @var integer
     *
     * @ORM\Column(name="event_category_id", type="integer", nullable=false)
     */
    protected $eventCategoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="overview", type="text", nullable=true)
     */
    protected $overview;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=100, nullable=true)
     */
    protected $image;

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
     * @var string
     *
     * @ORM\Column(name="itinerary_pdf", type="string", length=255, nullable=true)
     */
    protected $itineraryPdf;

    /**
     * @var integer
     *
     * @ORM\Column(name="approved", type="integer", nullable=true)
     */
    protected $approved = '1';

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
     * @ORM\Column(name="meta_keywords", type="text", nullable=true)
     */
    protected $metaKeywords;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    protected $status = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="event_priority", type="integer", nullable=true)
     */
    protected $eventPriority = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="category_id", type="integer", nullable=true)
     */
    protected $categoryId;



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
     * Set resortId
     *
     * @param integer $resortId
     * @return Events
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
     * Set userId
     *
     * @param integer $userId
     * @return Events
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
     * @return Events
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
     * @return Events
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
     * Set eventCategoryId
     *
     * @param integer $eventCategoryId
     * @return Events
     */
    public function setEventCategoryId($eventCategoryId)
    {
        $this->eventCategoryId = $eventCategoryId;

        return $this;
    }

    /**
     * Get eventCategoryId
     *
     * @return integer 
     */
    public function getEventCategoryId()
    {
        return $this->eventCategoryId;
    }

    /**
     * Set overview
     *
     * @param string $overview
     * @return Events
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
     * @return Events
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
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Events
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Events
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set minimumStayDays
     *
     * @param integer $minimumStayDays
     * @return Events
     */
    public function setMinimumStayDays($minimumStayDays)
    {
        $this->minimumStayDays = $minimumStayDays;

        return $this;
    }

    /**
     * Get minimumStayDays
     *
     * @return integer 
     */
    public function getMinimumStayDays()
    {
        return $this->minimumStayDays;
    }

    /**
     * Set itineraryPdf
     *
     * @param string $itineraryPdf
     * @return Events
     */
    public function setItineraryPdf($itineraryPdf)
    {
        $this->itineraryPdf = $itineraryPdf;

        return $this;
    }

    /**
     * Get itineraryPdf
     *
     * @return string 
     */
    public function getItineraryPdf()
    {
        return $this->itineraryPdf;
    }

    /**
     * Set approved
     *
     * @param integer $approved
     * @return Events
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * Get approved
     *
     * @return integer 
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set metaTitle
     *
     * @param string $metaTitle
     * @return Events
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
     * @return Events
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
     * @return Events
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
     * @return Events
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
     * Set eventPriority
     *
     * @param integer $eventPriority
     * @return Events
     */
    public function setEventPriority($eventPriority)
    {
        $this->eventPriority = $eventPriority;

        return $this;
    }

    /**
     * Get eventPriority
     *
     * @return integer 
     */
    public function getEventPriority()
    {
        return $this->eventPriority;
    }

    /**
     * Set categoryId
     *
     * @param integer $categoryId
     * @return Events
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
}
