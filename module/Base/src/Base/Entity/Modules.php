<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Modules
 *
 * @ORM\Table(name="modules")
 * @ORM\Entity
 */
class Modules extends Base\BaseEntity
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;
    
   
   
     /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
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
     * @ORM\Column(name="modified", type="datetime", nullable=true)
     */
    protected $modified;
    
   /* 
     /**
     *@var Base\Entity\Permissions
     * @OneToMany(targetEntity="Base\Entity\Permissions", mappedBy="module")
     **/
    //private $permissions;
    
    

    
   
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
     * @return Modules
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }
    
  
     /**
     * Set status
     *
     * @param integer $status
     * @return Modules
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }
    
     /**
     * Set created
     * 
     * @param \DateTime $createdAt
     * @return Modules
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }
    
     /**
     * Get created
     *
     * @return \DateTime  
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Get modified
     *
     * @param \DateTime $modified
     * @return Modules 
     */
    public function setModified($modified)
    {
        $this->modified = $modified;
        return $this;
    }
    
    /**
     * Get modified
     *
     * @return \DateTime  
     */
    public function getModified()
    {
        return $this->modified;
    }
    
     
    /**
     * Get permissions
     *
     * @return \Base\Entity\Permissions
     */
 /*   public function getPermissions()
    {
        return $this->permissions;
    }
*/
  
}
