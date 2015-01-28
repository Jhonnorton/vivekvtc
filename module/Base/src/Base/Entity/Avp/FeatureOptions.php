<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * FeatureOptions
 *
 * @ORM\Table(name="feature_options")
 * @ORM\Entity
 */
class FeatureOptions  extends\Base\Entity\Base\BaseEntity{

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
     * @ORM\Column(name="user_role", type="string", length=255, nullable=true)
     */
    private $userRole;
    
   
    
    /**
     * @var integer
     *
     * @ORM\Column(name="resort_id", type="integer", nullable=true)
     */
    protected $resortId;

    /**
     * @var integer
     *
     * @ORM\Column(name="event_id", type="integer", nullable=true)
     */
    protected $eventId;

    /**
     * @var integer
     *
     * @ORM\Column(name="cruise_id", type="integer", nullable=true)
     */
    protected $cruiseId;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    protected $status = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=true)
     */
    protected $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified_date", type="datetime", nullable=true)
     */
    protected $modified;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Set userId
     *
     * @param integer $userId
     * @return FeatureOptions
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

    
    
     
    /**
     * Set userRole
     *
     * @param string $userRole
     * @return FeatureOptions
     */
    public function setUserRole($userRole)
    {
        $this->userRole = $userRole;

        return $this;
    }

    /**
     * Get userRole
     *
     * @return string 
     */
    public function getUserRole()
    {
        return $this->userRole;
    }

    
    
    
    

    /**
     * Set resortId
     *
     * @param integer $resortId
     * @return FeatureOptions
     */
    public function setResortId($resortId) {
        $this->resortId = $resortId;

        return $this;
    }

    /**
     * Get resortId
     *
     * @return integer 
     */
    public function getResortId() {
        return $this->resortId;
    }

    /**
     * Set eventId
     *
     * @param integer $eventId
     * @return FeatureOptions
     */
    public function setEventId($eventId) {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return integer 
     */
    public function getEventId() {
        return $this->eventId;
    }

    /**
     * Set cruiseId
     *
     * @param integer $cruiseId
     * @return FeatureOptions
     */
    public function setCruiseId($cruiseId) {
        $this->cruiseId = $cruiseId;

        return $this;
    }

    /**
     * Get cruiseId
     *
     * @return integer 
     */
    public function getCruiseId() {
        return $this->cruiseId;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return FeatureOptions
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return FeatureOptions
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return FeatureOptions
     */
    public function setModified($modified) {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified() {
        return $this->modified;
    }

}
