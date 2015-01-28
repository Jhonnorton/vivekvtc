<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommunityWalls
 *
 * @ORM\Table(name="community_walls", indexes={@ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class CommunityWalls
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
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="video", type="string", length=255, nullable=true)
     */
    private $video;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creat_at", type="datetime", nullable=true)
     */
    private $creatAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_at", type="datetime", nullable=true)
     */
    private $updateAt;

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
     * @return CommunityWalls
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
     * @param string $photo
     * @return CommunityWalls
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set video
     *
     * @param string $video
     * @return CommunityWalls
     */
    public function setVideo($video)
    {
        $this->video = $video;

        return $this;
    }

    /**
     * Get video
     *
     * @return string 
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * Set creatAt
     *
     * @param \DateTime $creatAt
     * @return CommunityWalls
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
     * Set updateAt
     *
     * @param \DateTime $updateAt
     * @return CommunityWalls
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime 
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * Set user
     *
     * @param \Base\Entity\Avp\CommunityUsers $user
     * @return CommunityWalls
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
