<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * Galleries
 *
 * @ORM\Table(name="notifications")
 * @ORM\Entity
 */
class Notifications
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
     * @var \Base\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */	 
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="setting_name", type="string", nullable=false)
     */
    private $settingName;
	
	 /**
     * @var string
     *
     * @ORM\Column(name="send_to", type="string", nullable=false)
     */
    private $sendTo;
	
	 /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", nullable=false)
     */
    private $subject;
	
	 /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", nullable=false)
     */
    private $content;
	
	 /**
     * @var string
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;
	
	  /**
     * Get id
     *
     * @return integer 
     */
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
     * Set userId
     *
     * @param integer $userId
     * @return EventUsers
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }
}

