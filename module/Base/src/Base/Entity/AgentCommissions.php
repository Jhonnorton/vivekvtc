<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Table(name="agent_commissions")
 * @ORM\Entity
 */

class AgentCommissions extends Base\BaseEntity
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
     * @var \Base\Entity\Role
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * })
     */
    private $roleId;
    
    /**
     * @var \Base\Entity\Resource
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Resource")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     * })
     */
    private $resourceId;
    
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
     * @ORM\Column(name="commission_type", type="integer", nullable=true)
     */
    protected $commissionType;
    
        /**
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer", nullable=true)
     */
    protected $amount;
        /**
     * @var integer
     *
     * @ORM\Column(name="is_deleted", type="integer", nullable=true)
     */
    protected $isDeleted;
    
    
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
     * @return AgentCommissions
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
     * @return AgentCommissions
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
     * @return AgentCommissions
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
     * Set roleId
     *
     * @param integer $roleId
     * @return AgentCommissions
     */
    public function setRoleId($roleId) {
        $this->roleId = $roleId;

        return $this;
    }

    /**
     * Get roleId
     *
     * @return integer 
     */
    public function getRoleId() {
        return $this->roleId;
    }
   
    
    /**
     * Set resourceId
     *
     * @param integer $resourceId
     * @return AgentCommissions
     */
    public function setResourceId($resourceId) {
        $this->resourceId = $resourceId;

        return $this;
    }

    /**
     * Get resourceId
     *
     * @return integer 
     */
    public function getResourceId() {
        return $this->resourceId;
    }
    /**
     * Set amount
     *
     * @param integer $amount
     * @return AgentCommissions
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
     * Set commissionType
     *
     * @param integer $commissionType
     * @return AgentCommissions
     */
    public function setCommissionType($commissionType) {
        $this->commissionType = $commissionType;

        return $this;
    }

    /**
     * Get commissionType
     *
     * @return integer 
     */
    public function getCommissionType() {
        return $this->commissionType;
    }
   
    /**
     * Set isDeleted
     *
     * @param integer $isDeleted
     * @return AgentCommissions
     */
    public function setIsDeleted($isDeleted) {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get isDeleted
     *
     * @return integer 
     */
    public function getIsDeleted() {
        return $this->isDeleted;
    }
   
 
}
