<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Table(name="activity")
 * @ORM\Entity
 */

class Activity extends Base\BaseEntity
{
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
   
    protected $id;
    
   
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime", nullable=true)
     */
    protected $dateAdded;
    
        /**
     * @var \DateTime
     *
     * @ORM\Column(name="activity_name", type="string", nullable=true)
     */
    protected $activityName;
    
    /**
     * @var \Base\Entity\Reservation
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Reservation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reservation_id", referencedColumnName="id")
     * })
     */
    private $reservationId;
    
    
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
     * @return Activity
     */
    public function setUserId($userId) {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId() {
        return $this->userId;
    }

    
    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return Activity
     */
    public function setDateAdded($dateAdded) {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime 
     */
    public function getDateAdded() {
        return $this->dateAdded;
    }
    
    /**
     * Set activityName
     *
     * @param \DateTime $dateAdded
     * @return Activity
     */
    public function setActivityName($activityName) {
        $this->activityName = $activityName;

        return $this;
    }

    /**
     * Get activityName
     *
     * @return string 
     */
    public function getActivityName() {
        return $this->activityName;
    }
    
    /**
     * Set reservationId
     *
     * @param integer $reservationId
     * @return Activity
     */
    public function setReservationId($reservationId) {
        $this->reservationId = $reservationId;

        return $this;
    }

    /**
     * Get reservationId
     *
     * @return integer 
     */
    public function getReservationId() {
        return $this->reservationId;
    }
   

 
}
