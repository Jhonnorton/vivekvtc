<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clients
 *
 * @ORM\Table(name="clients")
 * @ORM\Entity
 */
class Clients extends \Base\Entity\Base\BaseEntity
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
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=true)
     */
    protected $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_id", type="string", length=50, nullable=true)
     */
    protected $customerId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    protected $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dob", type="date", nullable=true)
     */
    protected $dob;

    /**
     * @var string
     *
     * @ORM\Column(name="sex", type="string", length=20, nullable=false)
     */
    protected $sex = 'male';

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(name="address_line1", type="text", nullable=true)
     */
    protected $addressLine1;

    /**
     * @var string
     *
     * @ORM\Column(name="address_line2", type="text", nullable=true)
     */
    protected $addressLine2;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    protected $image;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=100, nullable=true)
     */
    protected $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="`key`", type="string", length=100, nullable=true)
     */
    protected $key;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="zip", type="string", length=100, nullable=true)
     */
    protected $zip;

    /**
     * @var integer
     *
     * @ORM\Column(name="parent_id", type="integer", nullable=true)
     */
    protected $parentId;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_id", type="integer", nullable=true)
     */
    protected $orderId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    protected $status = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="id_card_name", type="string", length=100, nullable=true)
     */
    protected $idCardName;

    /**
     * @var string
     *
     * @ORM\Column(name="id_card_user_name", type="string", length=100, nullable=true)
     */
    protected $idCardUserName;

    /**
     * @var string
     *
     * @ORM\Column(name="id_card_email", type="string", length=100, nullable=true)
     */
    protected $idCardEmail;



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
     * @return Clients
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set customerId
     *
     * @param string $customerId
     * @return Clients
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return string 
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Clients
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
     * Set dob
     *
     * @param \DateTime $dob
     * @return Clients
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
     * Set sex
     *
     * @param string $sex
     * @return Clients
     */
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get sex
     *
     * @return string 
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Clients
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
     * @return Clients
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
     * @return Clients
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
     * Set image
     *
     * @param string $image
     * @return Clients
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
     * Set phone
     *
     * @param string $phone
     * @return Clients
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
     * Set email
     *
     * @param string $email
     * @return Clients
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
     * Set city
     *
     * @param string $city
     * @return Clients
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
     * Set key
     *
     * @param string $key
     * @return Clients
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Get key
     *
     * @return string 
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Clients
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
     * @return Clients
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
     * @return Clients
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
     * Set parentId
     *
     * @param integer $parentId
     * @return Clients
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer 
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * Set orderId
     *
     * @param integer $orderId
     * @return Clients
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set status
     *
     * @param boolean $status
     * @return Clients
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
     * Set idCardName
     *
     * @param string $idCardName
     * @return Clients
     */
    public function setIdCardName($idCardName)
    {
        $this->idCardName = $idCardName;

        return $this;
    }

    /**
     * Get idCardName
     *
     * @return string 
     */
    public function getIdCardName()
    {
        return $this->idCardName;
    }

    /**
     * Set idCardUserName
     *
     * @param string $idCardUserName
     * @return Clients
     */
    public function setIdCardUserName($idCardUserName)
    {
        $this->idCardUserName = $idCardUserName;

        return $this;
    }

    /**
     * Get idCardUserName
     *
     * @return string 
     */
    public function getIdCardUserName()
    {
        return $this->idCardUserName;
    }

    /**
     * Set idCardEmail
     *
     * @param string $idCardEmail
     * @return Clients
     */
    public function setIdCardEmail($idCardEmail)
    {
        $this->idCardEmail = $idCardEmail;

        return $this;
    }

    /**
     * Get idCardEmail
     *
     * @return string 
     */
    public function getIdCardEmail()
    {
        return $this->idCardEmail;
    }
}
