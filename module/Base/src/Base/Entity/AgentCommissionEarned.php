<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AgentCommissionEarned
 *
 * @ORM\Table(name="agent_commission_earned")
 * @ORM\Entity
 */

class AgentCommissionEarned extends Base\BaseEntity
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
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer", nullable=true)
     */
    protected $amount;
        
    /**
     * @var integer
     *
     * @ORM\Column(name="commission_for", type="integer", nullable=true)
     */
    protected $commissionFor;
    
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
     * @var \Base\Entity\Avp\Affiliates
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Avp\Affiliates")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="affiliate_id", referencedColumnName="id")
     * })
     */
    private $affiliateId;
    
    
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
     * @return AgentCommissionEarned
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
     * Set created
     *
     * @param \DateTime $created
     * @return AgentCommissionEarned
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
     * @return AgentCommissionEarned
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
    
    /**
     * Set reservationId
     *
     * @param integer $reservationId
     * @return AgentCommissionEarned
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
    
    /**
     * Set affiliateId
     *
     * @param integer $affiliateId
     * @return AgentCommissionEarned
     */
    public function setAffiliateId($affiliateId) {
        $this->affiliateId = $affiliateId;

        return $this;
    }

    /**
     * Get affiliateId
     *
     * @return integer 
     */
    public function getAffiliateId() {
        return $this->affiliateId;
    }
    
    /**
     * Set amount
     *
     * @param integer $amount
     * @return AgentCommissionEarned
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
     * Set commissionFor
     *
     * @param integer $commissionFor
     * @return AgentCommissionEarned
     */
    public function setCommissionFor($commissionFor) {
        $this->commissionFor = $commissionFor;

        return $this;
    }

    /**
     * Get commissionFor
     *
     * @return integer 
     */
    public function getCommissionFor() {
        return $this->commissionFor;
    }

    
}