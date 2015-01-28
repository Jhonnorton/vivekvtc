<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * Galleries
 *
 * @ORM\Table(name="avp_profiles")
 * @ORM\Entity
 */
class AvpProfiles
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
     * @ORM\Column(name="api_key", type="string", length=255, nullable=false)
     */
    private $apiKey;

    /**
     * @var string
     *
     * @ORM\Column(name="event_category_id", type="string", length=50, nullable=false)
     */
    private $eventCategoryId;

    /**
     * @var string
     *
     * @ORM\Column(name="resort_category_id", type="string", nullable=true)
     */
    private $resortCategoryId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="cruises_category_id", type="string", nullable=true)
     */
    private $cruisesCategoryId;
    
    /**
     * @var \Base\Entity\Avp\Themes
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\Avp\Themes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="theme_id", referencedColumnName="id")
     * })
     */
    private $themeId;
    
     /**
     * @var \Base\Entity\Avp\Users
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\Avp\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="affiliate_id", referencedColumnName="id")
     * })
     */
    private $affiliateId;
    
     /**
     * @var string
     *
     * @ORM\Column(name="option", type="string",nullable=true)
     */
    private $option;
     /**
     * @var string
     *
     * @ORM\Column(name="color", type="string",nullable=true)
     */
    private $color;
     /**
     * @var string
     *
     * @ORM\Column(name="banner", type="string",nullable=true)
     */
    private $banner;
     /**
     * @var string
     *
     * @ORM\Column(name="content", type="string",nullable=true)
     */
    private $content;
     /**
     * @var string
     *
     * @ORM\Column(name="about_you", type="string",nullable=true)
     */
    private $aboutYou;
     /**
     * @var string
     *
     * @ORM\Column(name="resort_page", type="string",nullable=true)
     */
    private $resortPage;
     /**
     * @var string
     *
     * @ORM\Column(name="event_page", type="string",nullable=true)
     */
    private $eventPage;
     /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer",nullable=true)
     */
    private $status;
     /**
     * @var integer
     *
     * @ORM\Column(name="id_deleted", type="integer",nullable=true)
     */
    private $isDeleted;
    

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=false)
     */
    private $created;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime", nullable=false)
     */
    private $modified;



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
     * @return AvpProfiles
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
     * Set eventCategoryId
     *
     * @param string $eventCategoryId
     * @return AvpProfiles
     */
    public function setEventCategoryId($eventCategoryId)
    {
        $this->eventCategoryId = $eventCategoryId;

        return $this;
    }

    /**
     * Get eventCategoryId
     *
     * @return string 
     */
    public function getEventCategoryId()
    {
        return $this->eventCategoryId;
    }
    /**
     * Set resortCategoryId
     *
     * @param string $resortCategoryId
     * @return AvpProfiles
     */
    public function setResortCategoryId($resortCategoryId)
    {
        $this->resortCategoryId = $resortCategoryId;

        return $this;
    }

    /**
     * Get resortCategoryId
     *
     * @return string 
     */
    public function getResortCategoryId()
    {
        return $this->resortCategoryId;
    }
    /**
     * Set cruisesCategoryId
     *
     * @param string $cruisesCategoryId
     * @return AvpProfiles
     */
    public function setCruisesCategoryId($cruisesCategoryId)
    {
        $this->cruisesCategoryId = $cruisesCategoryId;

        return $this;
    }

    /**
     * Get cruisesCategoryId
     *
     * @return string 
     */
    public function getCruisesCategoryId()
    {
        return $this->cruisesCategoryId;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return AvpProfiles
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
     * Set isDeleted
     *
     * @param integer $isDeleted
     * @return AvpProfiles
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

        return $this;
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
     * Set themeId
     *
     * @param integer $themeId
     * @return AvpProfiles
     */
    public function setThemeId($themeId)
    {
        $this->themeId = $themeId;

        return $this;
    }

    /**
     * Get themeId
     *
     * @return integer 
     */
    public function getThemeId()
    {
        return $this->themeId;
    }
    /**
     * Set apiKey
     *
     * @param string $apiKey
     * @return AvpProfiles
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get apiKey
     *
     * @return string 
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }
    /**
     * Set affiliateId
     *
     * @param integer $affiliateId
     * @return AvpProfiles
     */
    public function setAffiliateId($affiliateId)
    {
        $this->affiliateId = $affiliateId;

        return $this;
    }

    /**
     * Get affiliateId
     *
     * @return integer 
     */
    public function getAffiliateId()
    {
        return $this->affiliateId;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return AvpProfiles
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
     * Set modified
     *
     * @param \DateTime $modified
     * @return AvpProfiles
     */
    public function setModified($modified)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified()
    {
        return $this->modified;
    }
    
     /**
     * Set option
     *
     * @param string $option
     * @return AvpProfiles
     */
    public function setOption($option)
    {
        $this->option = $option;

        return $this;
    }

    /**
     * Get option
     *
     * @return string 
     */
    public function getOption()
    {
        return $this->option;
    }
     /**
     * Set color
     *
     * @param string $color
     * @return AvpProfiles
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string 
     */
    public function getColor()
    {
        return $this->color;
    }
     /**
     * Set banner
     *
     * @param string $banner
     * @return AvpProfiles
     */
    public function setBanner($banner)
    {
        $this->banner = $banner;

        return $this;
    }

    /**
     * Get banner
     *
     * @return string 
     */
    public function getBanner()
    {
        return $this->banner;
    }
     /**
     * Set content
     *
     * @param string $content
     * @return AvpProfiles
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
     /**
     * Set aboutYou
     *
     * @param string $aboutYou
     * @return AvpProfiles
     */
    public function setAboutYou($aboutYou)
    {
        $this->aboutYou = $aboutYou;

        return $this;
    }

    /**
     * Get aboutYou
     *
     * @return string 
     */
    public function getAboutYou()
    {
        return $this->aboutYou;
    }
     /**
     * Set resortPage
     *
     * @param string $resortPage
     * @return AvpProfiles
     */
    public function setResortPage($resortPage)
    {
        $this->resortPage = $resortPage;

        return $this;
    }

    /**
     * Get resortPage
     *
     * @return string 
     */
    public function getResortPage()
    {
        return $this->resortPage;
    }
     /**
     * Set eventPage
     *
     * @param string $eventPage
     * @return AvpProfiles
     */
    public function setEventPage($eventPage)
    {
        $this->eventPage = $eventPage;

        return $this;
    }

    /**
     * Get eventPage
     *
     * @return string 
     */
    public function getEventPage()
    {
        return $this->eventPage;
    }
}
