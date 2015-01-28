<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * GalleryImages
 *
 * @ORM\Table(name="gallery_images")
 * @ORM\Entity
 */
class GalleryImages
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
     * @var integer
     *
     * @ORM\Column(name="gallery_id", type="integer", nullable=false)
     */
    private $galleryId;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=100, nullable=false)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added_on", type="datetime", nullable=true)
     */
    private $addedOn;



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
     * Set galleryId
     *
     * @param integer $galleryId
     * @return GalleryImages
     */
    public function setGalleryId($galleryId)
    {
        $this->galleryId = $galleryId;

        return $this;
    }

    /**
     * Get galleryId
     *
     * @return integer 
     */
    public function getGalleryId()
    {
        return $this->galleryId;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return GalleryImages
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
     * @return GalleryImages
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
     * Set addedOn
     *
     * @param \DateTime $addedOn
     * @return GalleryImages
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
}
