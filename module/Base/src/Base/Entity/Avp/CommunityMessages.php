<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommunityMessages
 *
 * @ORM\Table(name="community_messages", indexes={@ORM\Index(name="user_from", columns={"user_from"}), @ORM\Index(name="user_to", columns={"user_to"})})
 * @ORM\Entity
 */
class CommunityMessages
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
     *   @ORM\JoinColumn(name="user_from", referencedColumnName="id")
     * })
     */
    private $userFrom;

    /**
     * @var \Base\Entity\Avp\CommunityUsers
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Avp\CommunityUsers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_to", referencedColumnName="id")
     * })
     */
    private $userTo;



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
     * @return CommunityMessages
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
     * Set creatAt
     *
     * @param \DateTime $creatAt
     * @return CommunityMessages
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
     * Set userFrom
     *
     * @param \Base\Entity\Avp\CommunityUsers $userFrom
     * @return CommunityMessages
     */
    public function setUserFrom(\Base\Entity\Avp\CommunityUsers $userFrom = null)
    {
        $this->userFrom = $userFrom;

        return $this;
    }

    /**
     * Get userFrom
     *
     * @return \Base\Entity\Avp\CommunityUsers 
     */
    public function getUserFrom()
    {
        return $this->userFrom;
    }

    /**
     * Set userTo
     *
     * @param \Base\Entity\Avp\CommunityUsers $userTo
     * @return CommunityMessages
     */
    public function setUserTo(\Base\Entity\Avp\CommunityUsers $userTo = null)
    {
        $this->userTo = $userTo;

        return $this;
    }

    /**
     * Get userTo
     *
     * @return \Base\Entity\Avp\CommunityUsers 
     */
    public function getUserTo()
    {
        return $this->userTo;
    }
}
