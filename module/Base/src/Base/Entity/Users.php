<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users", indexes={@ORM\Index(name="FK_users_role_id", columns={"role_id"}), @ORM\Index(name="FK_users__country_id", columns={"country_id"})})})
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
     * @var string
     *
     * @ORM\Column(name="unique_id", type="string", length=100, nullable=true)
     */
    protected $uniqueId;
    
     /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=64, nullable=false)
     */
    protected $login;
    
     /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=128, nullable=true)
     */
     protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=128, nullable=true)
     */
    protected $state;

  
     /**
     * @var \Base\Entity\Countries
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Countries")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     * })
     */
    
    protected $country;

    /**
     * @var string
     *
     * @ORM\Column(name="zip", type="string", length=30, nullable=true)
     */
    protected $zip;
    
    
    
    
     /**
     * @var string
     *
     * @ORM\Column(name="rate", type="decimal", precision=10, scale=2, nullable=true)
     */
    protected $rate = '0.00';
    
     /**
     * @var boolean
     *
     * @ORM\Column(name="account_type", type="integer", nullable=true)
     */
    protected $accountType;
    
     /**
     * @var boolean
     *
     * @ORM\Column(name="pay_schedule", type="integer", nullable=true)
     */
    protected $paySchedule;
    
    
     /**
     * @var boolean
     *
     * @ORM\Column(name="bonus", type="integer", nullable=true)
     */
    protected $bonus;
 
    /**
     * @var boolean
     *
     * @ORM\Column(name="payroll", type="integer", nullable=true)
     */
    protected $payroll;
    
      /**
     * @var \DateTime
     *
     * @ORM\Column(name="starting_from", type="date", nullable=true)
     */
    protected $startingFrom;
        

    
    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    protected $phone;
    
     /**
     * @var string
     *
     * @ORM\Column(name="suite", type="string", length=255, nullable=true)
     */
    protected $suite;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=100, nullable=true)
     */
    protected $image;
    
     
    /**
     * @var string
     *
     * @ORM\Column(name="address_line1", type="string", length=255, nullable=true)
     */
    protected $address;
    
    
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="joined_on", type="datetime", nullable=true)
     */
    protected $joinedOn;
    
    
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_updated", type="datetime", nullable=true)
     */
    protected $lastUpdated;
    
    
     /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255, nullable=true)
     */
    protected $roleName="guest";
    
  
    
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


    
    /**
     * Set uniqueId
     *
     * @param string $uniqueId
     * @return Users
     */
    public function setUniqueId($uniqueId)
    {
        $this->uniqueId = $uniqueId;

        return $this;
    }

    /**
     * Get uniqueId
     *
     * @return string 
     */
    public function getUniqueId()
    {
        return $this->uniqueId;
    }
    
    /**
     * Set login
     *
     * @param string $login
     * @return Users
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }
	
    
    
     /**
     * Set rate
     *
     * @param string $rate
     * @return Users
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return string 
     */
    public function getRate()
    {
        return $this->rate;
    }
    
    
       
     /**
     * Set accountType
     *
     * @param integer $accountType
     * @return Users
     */
    public function setAccountType($accountType)
    {
        $this->accountType = $accountType;

        return $this;
    }

    /**
     * Get accountType
     *
     * @return integer 
     */
    public function getAccountType()
    {
        return $this->accountType;
    }
    
      /**
     * Set bonus
     *
     * @param integer $bonus
     * @return Users
     */
    public function setBonus($bonus)
    {
        $this->bonus = $bonus;

        return $this;
    }

    /**
     * Get bonus
     *
     * @return integer 
     */
    public function getBonus()
    {
        return $this->bonus;
    }
    
    
    
    
    
    
    
    
       /**
     * Set paySchedule
     *
     * @param integer $paySchedule
     * @return Users
     */
    public function setPaySchedule($paySchedule)
    {
        $this->paySchedule = $paySchedule;

        return $this;
    }

    /**
     * Get paySchedule
     *
     * @return integer 
     */
    public function getPaySchedule()
    {
        return $this->paySchedule;
    }
    
    
     /**
     * Set city
     *
     * @param string $city
     * @return Users
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Users
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Users
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set zip
     *
     * @param string $zip
     * @return Users
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string 
     */
    public function getZip()
    {
        return $this->zip;
    }
    
     /**
     * Set startingFrom
     *
     * @param \DateTime $startingFrom
     * @return Users
     */
    public function setStartingFrom($startingFrom)
    {
        $this->startingFrom = $startingFrom;

        return $this;
    }

    /**
     * Get startingFrom
     *
     * @return \DateTime 
     */
    public function getStartingFrom()
    {
        return $this->startingFrom;
    }
    
     /**
     * Set payroll
     *
     * @param integer $payroll
     * @return Users
     */
    public function setPayroll($payroll)
    {
        $this->payroll = $payroll;

        return $this;
    }

    /**
     * Get payroll
     *
     * @return integer 
     */
    public function getPayroll()
    {
        return $this->payroll;
    }
    
    
     /**
     * Set phone
     *
     * @param string $phone
     * @return Users
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }
    
     /**
     * Set suite
     *
     * @param string $suite
     * @return Users
     */
    public function setSuite($suite)
    {
        $this->suite = $suite;

        return $this;
    }

    /**
     * Get suite
     *
     * @return string 
     */
    public function getSuite()
    {
        return $this->suite;
    }
    
    
     /**
     * Set image
     *
     * @param string $image
     * @return Users
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
    
     /**
     * Set address
     *
     * @param string $address
     * @return Users
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }
    
       /**
     * Set joinedOn
     *
     * @param \DateTime $joinedOn
     * @return Users
     */
    public function setJoinedOn($joinedOn)
    {
        $this->joinedOn = $joinedOn;

        return $this;
    }

    /**
     * Get joinedOn
     *
     * @return \DateTime 
     */
    public function getJoinedOn()
    {
        return $this->joinedOn;
    }
    
       /**
     * Set $lastUpdated
     *
     * @param \DateTime $lastUpdated
     * @return Users
     */
    public function setLastUpdated($lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }

    /**
     * Get lastUpdated
     *
     * @return \DateTime 
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }
    
    
     /**
     * Set roleName
     *
     * @param string $roleName
     * @return Users
     */
    public function setRoleName($roleName)
    {
        $this->roleName = $roleName;

        return $this;
    }

    /**
     * Get roleName
     *
     * @return string 
     */
    public function getRoleName()
    {
        return $this->roleName;
    }  
    
}
