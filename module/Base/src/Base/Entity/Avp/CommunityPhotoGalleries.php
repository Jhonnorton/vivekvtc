<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommunityPhotoGalleries
 *
 * @ORM\Table(name="community_photo_galleries", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class CommunityPhotoGalleries
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
     * @var integer
     *
     * @ORM\Column(name="photo_id", type="integer", nullable=true)
     */
    private $photoId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creat_at", type="datetime", nullable=true)
     */
    private $creatAt;

    /**
     * @var \Base\Entity\Avp\CommunityUsers
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Avp\CommunityUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;



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
     * @return CommunityPhotoGalleries
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
     * Set photoId
     *
     * @param integer $photoId
     * @return CommunityPhotoGalleries
     */
    public function setPhotoId($photoId)
    {
        $this->photoId = $photoId;

        return $this;
    }

    /**
     * Get photoId
     *
     * @return integer 
     */
    public function getPhotoId()
    {
        return $this->photoId;
    }

    /**
     * Set creatAt
     *
     * @param \DateTime $creatAt
     * @return CommunityPhotoGalleries
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
     * Set user
     *
     * @param \Base\Entity\Avp\CommunityUsers $user
     * @return CommunityPhotoGalleries
     */
    public function setUser(\Base\Entity\Avp\CommunityUsers $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Base\Entity\Avp\CommunityUsers 
     */
    public function getUser()
    {
        return $this->user;
    }
}
