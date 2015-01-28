<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Table(name="reseller_accounts")
 * @ORM\Entity
 */

class ResellerAccounts extends Base\BaseEntity
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    protected $name;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="setup_fee", type="integer", nullable=true)
     */
    protected $setupFee;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="monthly_amount", type="integer", nullable=true)
     */
    protected $monthlyAmount;
    
      /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    protected $status;

 /**
     * @var integer
     *
     * @ORM\Column(name="time_span", type="integer", nullable=true)
     */
    protected $timespan;

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
     * Set name
     *
     * @param string $name
     * @return ResellerAccounts
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }
    /**
     * Set setupFee
     *
     * @param integer $setupFee
     * @return ResellerAccounts
     */
    public function setSetupFee($setupFee) {
        $this->setupFee = $setupFee;

        return $this;
    }

    /**
     * Get setupFee
     *
     * @return integer 
     */
    public function getSetupFee() {
        return $this->setupFee;
    }
    /**
     * Set monthlyAmount
     *
     * @param integer $monthlyAmount
     * @return ResellerAccounts
     */
    public function setMonthlyAmount($monthlyAmount) {
        $this->monthlyAmount = $monthlyAmount;

        return $this;
    }

    /**
     * Get monthlyAmount
     *
     * @return integer 
     */
    public function getmonthlyAmount() {
        return $this->monthlyAmount;
    }
    /**
     * Set status
     *
     * @param integer $status
     * @return ResellerAccounts
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Set timespan
     *
     * @param integer $timespan
     * @return ResellerAccounts
     */
    public function setTimespan($timespan) {
        $this->timespan = $timespan;

        return $this;
    }

    /**
     * Get timespan
     *
     * @return string 
     */
    public function getTimespan() {
        return $this->timespan;
    }

    /**
     * Set resellerRoleId
     *
     * @param integer $resellerRoleId
     * @return ResellerAccounts
     */
    public function setResellerRoleId($resellerRoleId) {
        $this->resellerRoleId = $resellerRoleId;

        return $this;
    }

    /**
     * Get resellerRoleId
     *
     * @return string 
     */
    public function getResellerRoleId() {
        return $this->resellerRoleId;
    }
    
    /**
     * Set created
     *
     * @param \DateTime $created
     * @return ResellerAccounts
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
     * @return ResellerAccounts
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

?>
