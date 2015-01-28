<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Vouchers
 *
 * @ORM\Table(name="vouchers")
 * @ORM\Entity
 */
class Vouchers extends Base\BaseEntity
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
     * @ORM\Column(name="voucher_code", type="string", nullable=true)
     */
    protected $voucherCode;

    /**
     * @var string
     *
     * @ORM\Column(name="voucher_name", type="string", nullable=true)
     */
    protected $voucherName;

    /**
     * @var integer
     *
     * @ORM\Column(name="template_id", type="integer",  nullable=true)
     */
    protected $templateId;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(name="receipient_name", type="string",length=255, nullable=true)
     */
    protected $receipientName;
    

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    protected $email;

    /**
     * @var inteher
     *
     * @ORM\Column(name="link_to_type", type="integer", nullable=true)
     */
    protected $linkToType;

    /**
     * @var integer
     *
     * @ORM\Column(name="link_to_type_name", type="integer", length=11, nullable=true)
     */
    protected $linkToTypeName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="discount", type="string", nullable=true)
     */
    protected $discount;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_of_use", type="integer", nullable=true)
     */
    protected $numberOfUse;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_unlimited", type="integer",  nullable=true)
     */
    protected $isUnlimited;

    /**
     * @var string
     *
     * @ORM\Column(name="details", type="string", nullable=true)
     */
    protected $details;
    
    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", nullable=true)
     */
    protected $image;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="from_date", type="date", nullable=true)
     */
    protected $fromDate;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="to_date", type="date", nullable=true)
     */
    protected $toDate;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="date", nullable=true)
     */
    protected $created;
   



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
     * Set Voucher code
     *
     * @param string $voucherCode
     * @return Vouchers
     */
    public function setVoucherCode($voucherCode)
    {
        $this->voucherCode = $voucherCode;

        return $this;
    }

    /**
     * Get Voucher Code
     *
     * @return string 
     */
    public function getVoucherCode()
    {
        return $this->voucherCode;
    }

    /**
     * Set Voucher name
     *
     * @param string $voucherName
     * @return Voucher
     */
    public function setVoucherName($voucherName)
    {
        $this->voucherName = $voucherName;

        return $this;
    }

    /**
     * Get Voucher Name
     *
     * @return string 
     */
    public function getVoucherName()
    {
        return $this->voucherName;
    }

    /**
     * Set Template Id
     *
     * @param integer $templateId
     * @return Vouchers
     */
    public function setTemplateId($templateId)
    {
        $this->templateId = $templateId;

        return $this;
    }

    /**
     * Get Template Id
     *
     * @return integer 
     */
    public function getTemplateId()
    {
        return $this->templateId;
    }

    /**
     * Set Type
     *
     * @param integer $type
     * @return Vouchers
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get Type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }
    
    /**
     * Set Receipient Name
     *
     * @param string $receipientName
     * @return Vouchers
     */
    public function setReceipientName($receipientName)
    {
        $this->receipientName = $receipientName;

        return $this;
    }

    /**
     * Get Receipient Name
     *
     * @return string 
     */
    public function getReceipientName()
    {
        return $this->receipientName;
    }
    
    /**
     * Set Email
     *
     * @param string $email
     * @return Vouchers
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get Email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Set Link To Type
     *
     * @param integer $linkToType
     * @return Vouchers
     */
    public function setLinkToType($linkToType)
    {
        $this->linkToType = $linkToType;

        return $this;
    }

    /**
     * Get Link To Type
     *
     * @return integer 
     */
    public function getLinkToType()
    {
        return $this->linkToType;
    }
    
    /**
     * Set linkToTypeName
     *
     * @param integer $linkToTypeName
     * @return Vouchers
     */
    public function setLinkToTypeName($linkToTypeName)
    {
        $this->linkToTypeName = $linkToTypeName;

        return $this;
    }

    /**
     * Get Link To Type Name
     *
     * @return integer 
     */
    public function getLinkToTypeName()
    {
        return $this->linkToTypeName;
    }
    
    
    /**
     * Set Discount
     *
     * @param integer $discount
     * @return Vouchers
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get Discount
     *
     * @return integer 
     */
    public function getDiscount()
    {
        return $this->discount;
    }
    
    /**
     * Set Number of use
     *
     * @param integer $numberOfUse
     * @return Vouchers
     */
    public function setNumberOfUse($numberOfUse)
    {
        $this->numberOfUse = $numberOfUse;

        return $this;
    }

    /**
     * Get Number Of Use
     *
     * @return integer 
     */
    public function getNumberOfUse()
    {
        return $this->numberOfUse;
    }
    
    /**
     * Set Is Unlimited
     *
     * @param integer $isUnlimited
     * @return Vouchers
     */
    public function setIsUnlimited($isUnlimited)
    {
        $this->isUnlimited = $isUnlimited;

        return $this;
    }

    /**
     * Get Is Unlimited
     *
     * @return integer 
     */
    public function getIsUnlimited()
    {
        return $this->isUnlimited;
    }
    
    /**
     * Set Details
     *
     * @param string $details
     * @return Vouchers
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get Details
     *
     * @return string 
     */
    public function getDetails()
    {
        return $this->details;
    }

    
    /**
     * Set Image
     *
     * @param string $image
     * @return Vouchers
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get Image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }
    
    /**
     * Set from Date
     *
     * @param \DateTime $fromDate
     * @return Vouchers
     */
    public function setFromDate($fromDate)
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    /**
     * Get From Date
     *
     * @return \DateTime 
     */
    public function getFromDate()
    {
        return $this->fromDate;
    }
    
    /**
     * Set To Date
     *
     * @param \DateTime $toDate
     * @return Vouchers
     */
    public function setToDate($toDate)
    {
        $this->toDate = $toDate;

        return $this;
    }

    /**
     * Get To Date
     *
     * @return \DateTime 
     */
    public function getToDate()
    {
        return $this->toDate;
    }
    
    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Vouchers
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get Created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }
   
}
