<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users", indexes={@ORM\Index(name="FK_users_role_id", columns={"role_id"})})
 * @ORM\Entity
 */
class Users extends Base\BaseEntity
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
     * @ORM\Column(name="password", type="string", length=32, nullable=false)
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=64, nullable=false)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=64, nullable=true)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=64, nullable=true)
     */
    protected $lastName;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    protected $isActive = '1';
    
    /**
     * @var \Base\Entity\Role
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * })
     */
    protected $role;

       
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
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Users
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Users
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    
    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Users
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    
     /**
     * Set role
     *
     * @param \Base\Entity\Role $role
     * @return Users
     */
    public function setRole(\Base\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }
    
   

    /**
     * Get role
     *
     * @return \Base\Entity\Role 
     */
    public function getRole()
    {
        return $this->role;
    }
	
    
}
