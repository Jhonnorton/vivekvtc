<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * Affiliates
 *
 * @ORM\Table(name="affiliates",uniqueConstraints={@ORM\UniqueConstraint(name="email", columns={"email"})})
 * @ORM\Entity
 */
class Affiliates
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
     * @var \Base\Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;
    /**
     * @var string
     *
     * @ORM\Column(name="url_extension", type="string", length=255, nullable=false)
     */
    private $urlExtension;

    /**
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", length=255, nullable=true)
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="domain_url", type="string", length=255, nullable=true)
     */
    private $domainUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="thank_you_page", type="string", length=255, nullable=true)
     */
    private $thankYouPage;

    /**
     * @var string
     *
     * @ORM\Column(name="decline_page", type="string", length=255, nullable=true)
     */
    private $declinePage;

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
     * @ORM\Column(name="api_key", type="string", length=20, nullable=false)
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
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    private $type;
    /**
     * @var string
     *
     * @ORM\Column(name="agency_name", type="string", nullable=true)
     */
    private $agencyName;
    /**
     * @var string
     *
     * @ORM\Column(name="agency_reg_no", type="string", nullable=true)
     */
    private $agencyRegNo;
    /**
     * @var string
     *
     * @ORM\Column(name="website_url", type="string", nullable=true)
     */
    private $websiteUrl;
    /**
     * @var integer
     *
     * @ORM\Column(name="setup_fee", type="integer", nullable=true)
     */
    private $setupFee;
    /**
     * @var integer
     *
     * @ORM\Column(name="monthly_recurring_amount", type="integer", nullable=true)
     */
    private $monthlyRecurringAmount;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="monthly_recurring_date", type="datetime", nullable=true)
     */
    private $monthlyRecurringDate;
    /**
     * @var integer
     *
     * @ORM\Column(name="discount_type", type="integer", nullable=true)
     */
    private $discountType;
    /**
     * @var integer
     *
     * @ORM\Column(name="discount_amount", type="integer", nullable=true)
     */
    private $discountAmount;
    /**
     * @var integer
     *
     * @ORM\Column(name="travel_agent", type="integer", nullable=true)
     */
    private $travelAgent;
    /**
     * @var integer
     *
     * @ORM\Column(name="paid", type="integer", nullable=true)
     */
    private $paid;
    /**
     * @var decimal
     *
     * @ORM\Column(name="final_amount", type="decimal", nullable=true)
     */
    private $finalAmount;
    /**
     * @var string
     *
     * @ORM\Column(name="transaction_id", type="string", nullable=true)
     */
    private $transactionId;
    /**
     * @var string
     *
     * @ORM\Column(name="paypal_profile_id", type="string", nullable=true)
     */
    private $paypalProfileId="";
    /**
     * @var string
     *
     * @ORM\Column(name="paypal_profile_status", type="string", nullable=true)
     */
    private $paypalProfileStatus="";
    /**
     * @var string
     *
     * @ORM\Column(name="paypal_recurring_transaction_id", type="string", nullable=true)
     */
    private $paypalRecurringTransactionId="";

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
     * @return Affiliates
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
     * @return Affiliates
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
     * Set name
     *
     * @param string $name
     * @return Affiliates
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
     * Set urlExtension
     *
     * @param string $urlExtension
     * @return Affiliates
     */
    public function setUrlExtension($urlExtension)
    {
        $this->urlExtension = $urlExtension;

        return $this;
    }

    /**
     * Get urlExtension
     *
     * @return string 
     */
    public function getUrlExtension()
    {
        return $this->urlExtension;
    }

    /**
     * Set companyName
     *
     * @param string $companyName
     * @return Affiliates
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
     * Set domainUrl
     *
     * @param string $domainUrl
     * @return Affiliates
     */
    public function setDomainUrl($domainUrl)
    {
        $this->domainUrl = $domainUrl;

        return $this;
    }

    /**
     * Get domainUrl
     *
     * @return string 
     */
    public function getDomainUrl()
    {
        return $this->domainUrl;
    }

    /**
     * Set thankYouPage
     *
     * @param string $thankYouPage
     * @return Affiliates
     */
    public function setThankYouPage($thankYouPage)
    {
        $this->thankYouPage = $thankYouPage;

        return $this;
    }

    /**
     * Get thankYouPage
     *
     * @return string 
     */
    public function getThankYouPage()
    {
        return $this->thankYouPage;
    }

    /**
     * Set declinePage
     *
     * @param string $declinePage
     * @return Affiliates
     */
    public function setDeclinePage($declinePage)
    {
        $this->declinePage = $declinePage;

        return $this;
    }

    /**
     * Get declinePage
     *
     * @return string 
     */
    public function getDeclinePage()
    {
        return $this->declinePage;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Affiliates
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
     * @return Affiliates
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
     * Set addressLine1
     *
     * @param string $addressLine1
     * @return Affiliates
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
     * @return Affiliates
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
     * @return Affiliates
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
     * @return Affiliates
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
     * @return Affiliates
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
     * @return Affiliates
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
     * @return Affiliates
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
     * @return Affiliates
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
     * @return Affiliates
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
     * @return Affiliates
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
     * @return Affiliates
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
     * Set type
     *
     * @param integer $type
     * @return Affiliates
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * Set agencyName
     *
     * @param string $agencyName
     * @return Affiliates
     */
    public function setAgencyName($agencyName)
    {
        $this->agencyName = $agencyName;

        return $this;
    }

    /**
     * Get agencyName
     *
     * @return integer 
     */
    public function getAgencyName()
    {
        return $this->agencyName;
    }
    /**
     * Set agencyRegNo
     *
     * @param string $agencyRegNo
     * @return Affiliates
     */
    public function setAgencyRegNo($agencyRegNo)
    {
        $this->agencyRegNo = $agencyRegNo;

        return $this;
    }

    /**
     * Get agencyRegNo
     *
     * @return integer 
     */
    public function getAgencyRegNo()
    {
        return $this->agencyRegNo;
    }
    /**
     * Set websiteUrl
     *
     * @param string $websiteUrl
     * @return Affiliates
     */
    public function setWebsiteUrl($websiteUrl)
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    /**
     * Get websiteUrl
     *
     * @return string 
     */
    public function getWebsiteUrl()
    {
        return $this->websiteUrl;
    }
    /**
     * Set setupFee
     *
     * @param integer $setupFee
     * @return Affiliates
     */
    public function setSetupFee($setupFee)
    {
        $this->setupFee = $setupFee;

        return $this;
    }

    /**
     * Get setupFee
     *
     * @return string 
     */
    public function getSetupFee()
    {
        return $this->setupFee;
    }
    /**
     * Set monthlyRecurringAmount
     *
     * @param integer $monthlyRecurringAmount
     * @return Affiliates
     */
    public function setMonthlyRecurringAmount($monthlyRecurringAmount)
    {
        $this->monthlyRecurringAmount = $monthlyRecurringAmount;

        return $this;
    }

    /**
     * Get monthlyRecurringAmount
     *
     * @return integer 
     */
    public function getMonthlyRecurringAmount()
    {
        return $this->monthlyRecurringAmount;
    }
    /**
     * Set monthlyRecurringDate
     *
     * @param \DateTime $monthlyRecurringDate
     * @return Affiliates
     */
    public function setMonthlyRecurringDate($monthlyRecurringDate)
    {
        $this->monthlyRecurringDate = $monthlyRecurringDate;

        return $this;
    }

    /**
     * Get monthlyRecurringDate
     *
     * @return \DateTime 
     */
    public function getMonthlyRecurringDate()
    {
        return $this->monthlyRecurringDate;
    }
    /**
     * Set discountType
     *
     * @param integer $discountType
     * @return Affiliates
     */
    public function setDiscountType($discountType)
    {
        $this->discountType = $discountType;

        return $this;
    }

    /**
     * Get discountType
     *
     * @return integer 
     */
    public function getDiscountType()
    {
        return $this->discountType;
    }
    /**
     * Set discountAmount
     *
     * @param integer $discountAmount
     * @return Affiliates
     */
    public function setDiscountAmount($discountAmount)
    {
        $this->discountAmount = $discountAmount;

        return $this;
    }

    /**
     * Get discountAmount
     *
     * @return integer 
     */
    public function getDiscountAmount()
    {
        return $this->discountAmount;
    }
    /**
     * Set travelAgent
     *
     * @param integer $travelAgent
     * @return Affiliates
     */
    public function setTravelAgent($travelAgent)
    {
        $this->travelAgent = $travelAgent;

        return $this;
    }

    /**
     * Get travelAgent
     *
     * @return integer 
     */
    public function getTravelAgent()
    {
        return $this->travelAgent;
    }
    /**
     * Set paid
     *
     * @param integer $paid
     * @return Affiliates
     */
    public function setPaid($paid)
    {
        $this->paid = $paid;

        return $this;
    }

    /**
     * Get paid
     *
     * @return integer 
     */
    public function getPaid()
    {
        return $this->paid;
    }
    /**
     * Set finalAmount
     *
     * @param decimal $finalAmount
     * @return Affiliates
     */
    public function setFinalAmount($finalAmount)
    {
        $this->finalAmount = $finalAmount;

        return $this;
    }

    /**
     * Get finalAmount
     *
     * @return decimal 
     */
    public function getFinalAmount()
    {
        return $this->finalAmount;
    }
    /**
     * Set transactionId
     *
     * @param string $transactionId
     * @return Affiliates
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    /**
     * Get transactionId
     *
     * @return string 
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }
    /**
     * Set paypalProfileId
     *
     * @param string $paypalProfileId
     * @return Affiliates
     */
    public function setPaypalProfileId($paypalProfileId)
    {
        $this->paypalProfileId = $paypalProfileId;

        return $this;
    }

    /**
     * Get paypalProfileId
     *
     * @return string 
     */
    public function getPaypalProfileId()
    {
        return $this->paypalProfileId;
    }
    /**
     * Set paypalProfileStatus
     *
     * @param string $paypalProfileStatus
     * @return Affiliates
     */
    public function setPaypalProfileStatus($paypalProfileStatus)
    {
        $this->paypalProfileStatus = $paypalProfileStatus;

        return $this;
    }

    /**
     * Get paypalProfileStatus
     *
     * @return string 
     */
    public function getPaypalProfileStatus()
    {
        return $this->paypalProfileStatus;
    }
    /**
     * Set paypalRecurringTransactionId
     *
     * @param string $paypalRecurringTransactionId
     * @return Affiliates
     */
    public function setPaypalRecurringTransactionId($paypalRecurringTransactionId)
    {
        $this->paypalRecurringTransactionId = $paypalRecurringTransactionId;

        return $this;
    }

    /**
     * Get paypalRecurringTransactionId
     *
     * @return string 
     */
    public function getPaypalRecurringTransactionId()
    {
        return $this->paypalRecurringTransactionId;
    }
}
