<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventUsers
 *
 * @ORM\Table(name="event_users", uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})})
 * @ORM\Entity
 */
class EventUsers
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     */
    private $userId;

    /**
     * @var integer
     *
     * @ORM\Column(name="affiliate_package_id", type="integer", nullable=false)
     */
    private $affiliatePackageId;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", length=255, nullable=true)
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=50, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="key", type="string", length=100, nullable=false)
     */
    private $key;

    /**
     * @var string
     *
     * @ORM\Column(name="address_line1", type="string", length=255, nullable=true)
     */
    private $addressLine1;

    /**
     * @var string
     *
     * @ORM\Column(name="address_line2", type="string", length=255, nullable=true)
     */
    private $addressLine2;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255, nullable=true)
     */
    private $state;

    /**
     * @var integer
     *
     * @ORM\Column(name="country_id", type="integer", nullable=true)
     */
    private $countryId;

    /**
     * @var string
     *
     * @ORM\Column(name="affiliate_key", type="string", length=50, nullable=false)
     */
    private $affiliateKey;

    /**
     * @var string
     *
     * @ORM\Column(name="api_key", type="string", length=100, nullable=false)
     */
    private $apiKey;

    /**
     * @var integer
     *
     * @ORM\Column(name="payment_type", type="integer", nullable=true)
     */
    private $paymentType;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_blocked", type="integer", nullable=true)
     */
    private $isBlocked;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_approved", type="integer", nullable=true)
     */
    private $isApproved;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_updated", type="datetime", nullable=true)
     */
    private $lastUpdated;



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
     * @return EventUsers
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
     * Set affiliatePackageId
     *
     * @param integer $affiliatePackageId
     * @return EventUsers
     */
    public function setAffiliatePackageId($affiliatePackageId)
    {
        $this->affiliatePackageId = $affiliatePackageId;

        return $this;
    }

    /**
     * Get affiliatePackageId
     *
     * @return integer 
     */
    public function getAffiliatePackageId()
    {
        return $this->affiliatePackageId;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return EventUsers
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
     * @return EventUsers
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
     * Set companyName
     *
     * @param string $companyName
     * @return EventUsers
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string 
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return EventUsers
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
     * @return EventUsers
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
     * Set key
     *
     * @param string $key
     * @return EventUsers
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
     * Set addressLine1
     *
     * @param string $addressLine1
     * @return EventUsers
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
     * @return EventUsers
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
     * @return EventUsers
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
     * @return EventUsers
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
     * @return EventUsers
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
     * Set affiliateKey
     *
     * @param string $affiliateKey
     * @return EventUsers
     */
    public function setAffiliateKey($affiliateKey)
    {
        $this->affiliateKey = $affiliateKey;

        return $this;
    }

    /**
     * Get affiliateKey
     *
     * @return string 
     */
    public function getAffiliateKey()
    {
        return $this->affiliateKey;
    }

    /**
     * Set apiKey
     *
     * @param string $apiKey
     * @return EventUsers
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get apiKey
     *
     * @return string 
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set paymentType
     *
     * @param integer $paymentType
     * @return EventUsers
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    /**
     * Get paymentType
     *
     * @return integer 
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * Set isBlocked
     *
     * @param integer $isBlocked
     * @return EventUsers
     */
    public function setIsBlocked($isBlocked)
    {
        $this->isBlocked = $isBlocked;

        return $this;
    }

    /**
     * Get isBlocked
     *
     * @return integer 
     */
    public function getIsBlocked()
    {
        return $this->isBlocked;
    }

    /**
     * Set isApproved
     *
     * @param integer $isApproved
     * @return EventUsers
     */
    public function setIsApproved($isApproved)
    {
        $this->isApproved = $isApproved;

        return $this;
    }

    /**
     * Get isApproved
     *
     * @return integer 
     */
    public function getIsApproved()
    {
        return $this->isApproved;
    }

    /**
     * Set lastUpdated
     *
     * @param \DateTime $lastUpdated
     * @return EventUsers
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
