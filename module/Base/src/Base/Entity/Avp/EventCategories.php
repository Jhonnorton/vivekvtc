<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventCategories
 *
 * @ORM\Table(name="event_categories")
 * @ORM\Entity
 */
class EventCategories extends \Base\Entity\Base\BaseEntity
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=128, nullable=true)
     */
    protected $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="overview", type="text", nullable=true)
     */
    protected $overview;

    /**
     * @var string
     *
     * @ORM\Column(name="page_heading", type="text", nullable=true)
     */
    protected $pageHeading;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    protected $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="order_num", type="boolean", nullable=true)
     */
    protected $orderNum;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_title", type="string", length=128, nullable=true)
     */
    protected $metaTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="string", length=255, nullable=true)
     */
    protected $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keywords", type="string", length=128, nullable=true)
     */
    protected $metaKeywords;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_active", type="integer", nullable=false)
     */
    protected $isActive = '1';



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
     * @return EventCategories
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
     * Set slug
     *
     * @param string $slug
     * @return EventCategories
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set overview
     *
     * @param string $overview
     * @return EventCategories
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
     * Set pageHeading
     *
     * @param string $pageHeading
     * @return EventCategories
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
     * Set description
     *
     * @param string $description
     * @return EventCategories
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
     * Set orderNum
     *
     * @param boolean $orderNum
     * @return EventCategories
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
     * Set metaTitle
     *
     * @param string $metaTitle
     * @return EventCategories
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
     * @return EventCategories
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
     * @return EventCategories
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
     * Set isActive
     *
     * @param integer $isActive
     * @return EventCategories
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return integer 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
}
