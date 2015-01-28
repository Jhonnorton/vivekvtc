<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * WpSodaheadUser
 *
 * @ORM\Table(name="wp_sodahead_user")
 * @ORM\Entity
 */
class WpSodaheadUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=128, nullable=false)
     */
    private $token;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expires", type="datetime", nullable=false)
     */
    private $expires;



    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return WpSodaheadUser
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set expires
     *
     * @param \DateTime $expires
     * @return WpSodaheadUser
     */
    public function setExpires($expires)
    {
        $this->expires = $expires;

        return $this;
    }

    /**
     * Get expires
     *
     * @return \DateTime 
     */
    public function getExpires()
    {
        return $this->expires;
    }
}
