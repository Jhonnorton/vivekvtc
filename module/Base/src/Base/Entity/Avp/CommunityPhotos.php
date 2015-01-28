<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommunityPhotos
 *
 * @ORM\Table(name="community_photos", indexes={@ORM\Index(name="community_photos_ibfk_1", columns={"gallery_id"})})
 * @ORM\Entity
 */
class CommunityPhotos
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_path", type="string", length=255, nullable=true)
     */
    private $photoPath;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creat_at", type="datetime", nullable=true)
     */
    private $creatAt;

    /**
     * @var \Base\Entity\Avp\CommunityPhotoGalleries
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Avp\CommunityPhotoGalleries")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="gallery_id", referencedColumnName="id")
     * })
     */
    private $gallery;



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
     * @return CommunityPhotos
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
     * Set photoPath
     *
     * @param string $photoPath
     * @return CommunityPhotos
     */
    public function setPhotoPath($photoPath)
    {
        $this->photoPath = $photoPath;

        return $this;
    }

    /**
     * Get photoPath
     *
     * @return string 
     */
    public function getPhotoPath()
    {
        return $this->photoPath;
    }

    /**
     * Set creatAt
     *
     * @param \DateTime $creatAt
     * @return CommunityPhotos
     */
    public function setCreatAt($creatAt)
    {
        $this->creatAt = $creatAt;

        return $this;
    }

    /**
     * Get creatAt
     *
     * @return \DateTime 
     */
    public function getCreatAt()
    {
        return $this->creatAt;
    }

    /**
     * Set gallery
     *
     * @param \Base\Entity\Avp\CommunityPhotoGalleries $gallery
     * @return CommunityPhotos
     */
    public function setGallery(\Base\Entity\Avp\CommunityPhotoGalleries $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Base\Entity\Avp\CommunityPhotoGalleries 
     */
    public function getGallery()
    {
        return $this->gallery;
    }
}
