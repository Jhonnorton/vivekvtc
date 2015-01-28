<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Table(name="reseller_roles")
 * @ORM\Entity
 */

class ResellerRoles extends Base\BaseEntity
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
     * @ORM\Column(name="role_name", type="string", nullable=true)
     */
    protected $roleName;
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
     * Set roleName
     *
     * @param string $roleName
     * @return ResellerRoles
     */
    public function setRoleName($roleName) {
        $this->roleName = $roleName;

        return $this;
    }

    /**
     * Get roleName
     *
     * @return string 
     */
    public function getRoleName() {
        return $this->roleName;
    }
    
    /**
     * Set created
     *
     * @param \DateTime $created
     * @return ResellerRoles
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
     * @return ResellerRoles
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