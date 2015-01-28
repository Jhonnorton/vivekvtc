<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Table(name="reseller_roles_activity")
 * @ORM\Entity
 */

class ResellerRolesActivity extends Base\BaseEntity
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
     * @var \Base\Entity\ResellerRoles
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\ResellerRoles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reseller_role_id", referencedColumnName="id")
     * })
     */
    private $resellerRoleId;
    
      /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    protected $name;
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
     * Set name
     *
     * @param string $name
     * @return ResellerRolesActivity
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
     * Set status
     *
     * @param integer $status
     * @return ResellerRolesActivity
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
     * Set resellerRoleId
     *
     * @param integer $resellerRoleId
     * @return ResellerRolesActivity
     */
    public function setResellerRoleId($resellerRoleId) {
        $this->resellerRoleId = $resellerRoleId;

        return $this;
    }

    /**
     * Get resellerRoleId
     *
     * @return integer 
     */
    public function getResellerRoleId() {
        return $this->resellerRoleId;
    }
    
    /**
     * Set created
     *
     * @param \DateTime $created
     * @return ResellerRolesActivity
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
     * @return ResellerRolesActivity
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