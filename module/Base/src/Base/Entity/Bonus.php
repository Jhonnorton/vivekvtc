<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Table(name="bonus")
 * @ORM\Entity
 */

class Bonus extends Base\BaseEntity
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
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer", nullable=true)
     */
    protected $amount;
    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    protected $type;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    protected $status;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    protected $created;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    protected $updated;
    
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
     * Set amount
     *
     * @param integer $amount
     * @return Activity
     */
    public function setAmount($amount) {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount() {
        return $this->amount;
    }
    /**
     * Set type
     *
     * @param integer $type
     * @return Activity
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType() {
        return $this->type;
    }
    /**
     * Set status
     *
     * @param integer $status
     * @return Activity
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
     * @return Activity
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
     * Set updated
     *
     * @param \DateTime $updated
     * @return Activity
     */
    public function setUpdated($updated) {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated() {
        return $this->updated;
    }
}