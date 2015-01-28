<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommunityInterests
 *
 * @ORM\Table(name="community_interests", indexes={@ORM\Index(name="community_interests_ibfk_1", columns={"user_from"}), @ORM\Index(name="community_interests_ibfk_2", columns={"user_to"})})
 * @ORM\Entity
 */
class CommunityInterests
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
     *   @ORM\JoinColumn(name="user_to", referencedColumnName="id")
     * })
     */
    private $userTo;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set creatAt
     *
     * @param \DateTime $creatAt
     * @return CommunityInterests
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
     * Set userTo
     *
     * @param \Base\Entity\Avp\CommunityUsers $userTo
     * @return CommunityInterests
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

    /**
     * Set userFrom
     *
     * @param \Base\Entity\Avp\CommunityUsers $userFrom
     * @return CommunityInterests
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
}
