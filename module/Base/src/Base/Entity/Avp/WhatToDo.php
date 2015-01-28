<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * WhatToDo
 *
 * @ORM\Table(name="what_to_do")
 * @ORM\Entity
 */
class WhatToDo
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
     * @ORM\Column(name="title", type="string", length=64, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="text", nullable=false)
     */
    private $image;

    /**
     * @var integer
     *
     * @ORM\Column(name="parishes_id", type="integer", nullable=true)
     */
    private $parishesId;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating_id", type="integer", nullable=true)
     */
    private $ratingId;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="text", nullable=true)
     */
    private $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keywords", type="text", nullable=true)
     */
    private $metaKeywords;



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
     * @return WhatToDo
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
     * @return WhatToDo
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
     * @return WhatToDo
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
     * Set parishesId
     *
     * @param integer $parishesId
     * @return WhatToDo
     */
    public function setParishesId($parishesId)
    {
        $this->parishesId = $parishesId;

        return $this;
    }

    /**
     * Get parishesId
     *
     * @return integer 
     */
    public function getParishesId()
    {
        return $this->parishesId;
    }

    /**
     * Set ratingId
     *
     * @param integer $ratingId
     * @return WhatToDo
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
     * Set metaDescription
     *
     * @param string $metaDescription
     * @return WhatToDo
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
     * @return WhatToDo
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
}
