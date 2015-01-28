<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommunityWallComments
 *
 * @ORM\Table(name="community_wall_comments", indexes={@ORM\Index(name="wall_id", columns={"wall_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class CommunityWallComments
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
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var \Base\Entity\Avp\CommunityWalls
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Avp\CommunityWalls")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="wall_id", referencedColumnName="id")
     * })
     */
    private $wall;

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
     * @return CommunityWallComments
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
     * @return CommunityWallComments
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
     * @return CommunityWallComments
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
     * Set date
     *
     * @param \DateTime $date
     * @return CommunityWallComments
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set wall
     *
     * @param \Base\Entity\Avp\CommunityWalls $wall
     * @return CommunityWallComments
     */
    public function setWall(\Base\Entity\Avp\CommunityWalls $wall = null)
    {
        $this->wall = $wall;

        return $this;
    }

    /**
     * Get wall
     *
     * @return \Base\Entity\Avp\CommunityWalls 
     */
    public function getWall()
    {
        return $this->wall;
    }

    /**
     * Set user
     *
     * @param \Base\Entity\Avp\CommunityUsers $user
     * @return CommunityWallComments
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
