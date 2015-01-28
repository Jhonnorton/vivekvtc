<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class Users extends \Base\Entity\Base\BaseEntity 
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
     * @ORM\Column(name="unique_id", type="string", length=100, nullable=true)
     */
    protected $uniqueId;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=50, nullable=true)
     */
    protected $role = 'affiliate';

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255, nullable=false)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=false)
     */
    protected $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dob", type="date", nullable=false)
     */
    protected $dob;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=false)
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(name="address_line1", type="string", length=255, nullable=true)
     */
    protected $addressLine1;

    /**
     * @var string
     *
     * @ORM\Column(name="address_line2", type="string", length=255, nullable=true)
     */
    protected $addressLine2;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255, nullable=false)
     */
    protected $state;

    /**
     * @var integer
     *
     * @ORM\Column(name="country_id", type="integer", nullable=false)
     */
    protected $countryId;

    /**
     * @var string
     *
     * @ORM\Column(name="zip", type="string", length=255, nullable=true)
     */
    protected $zip;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    protected $status = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="tmp_password", type="text", nullable=false)
     */
    protected $tmpPassword;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_approved", type="boolean", nullable=true)
     */
    protected $isApproved = '0';

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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
     * Set role
     *
     * @param string $role
     * @return Users
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string 
     */
    public function getRole()
    {
        return $this->role;
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
     * Set dob
     *
     * @param \DateTime $dob
     * @return Users
     */
    public function setDob($dob)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob
     *
     * @return \DateTime 
     */
    public function getDob()
    {
        return $this->dob;
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
     * Set addressLine1
     *
     * @param string $addressLine1
     * @return Users
     */
    public function setAddressLine1($addressLine1)
    {
        $this->addressLine1 = $addressLine1;

        return $this;
    }

    /**
     * Get addressLine1
     *
     * @return string 
     */
    public function getAddressLine1()
    {
        return $this->addressLine1;
    }

    /**
     * Set addressLine2
     *
     * @param string $addressLine2
     * @return Users
     */
    public function setAddressLine2($addressLine2)
    {
        $this->addressLine2 = $addressLine2;

        return $this;
    }

    /**
     * Get addressLine2
     *
     * @return string 
     */
    public function getAddressLine2()
    {
        return $this->addressLine2;
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
     * Set countryId
     *
     * @param integer $countryId
     * @return Users
     */
    public function setCountryId($countryId)
    {
        $this->countryId = $countryId;

        return $this;
    }

    /**
     * Get countryId
     *
     * @return integer 
     */
    public function getCountryId()
    {
        return $this->countryId;
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
     * Set status
     *
     * @param boolean $status
     * @return Users
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set tmpPassword
     *
     * @param string $tmpPassword
     * @return Users
     */
    public function setTmpPassword($tmpPassword)
    {
        $this->tmpPassword = $tmpPassword;

        return $this;
    }

    /**
     * Get tmpPassword
     *
     * @return string 
     */
    public function getTmpPassword()
    {
        return $this->tmpPassword;
    }

    /**
     * Set isApproved
     *
     * @param boolean $isApproved
     * @return Users
     */
    public function setIsApproved($isApproved)
    {
        $this->isApproved = $isApproved;

        return $this;
    }

    /**
     * Get isApproved
     *
     * @return boolean 
     */
    public function getIsApproved()
    {
        return $this->isApproved;
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
     * Set lastUpdated
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
}
