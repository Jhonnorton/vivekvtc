<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommunityPhotoComments
 *
 * @ORM\Table(name="community_photo_comments", indexes={@ORM\Index(name="photo_id", columns={"photo_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class CommunityPhotoComments
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
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    private $text;

    /**
     * @var \Base\Entity\Avp\CommunityPhotos
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Avp\CommunityPhotos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="photo_id", referencedColumnName="id")
     * })
     */
    private $photo;

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
     * Set text
     *
     * @param string $text
     * @return CommunityPhotoComments
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set photo
     *
     * @param \Base\Entity\Avp\CommunityPhotos $photo
     * @return CommunityPhotoComments
     */
    public function setPhoto(\Base\Entity\Avp\CommunityPhotos $photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return \Base\Entity\Avp\CommunityPhotos 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set user
     *
     * @param \Base\Entity\Avp\CommunityUsers $user
     * @return CommunityPhotoComments
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
