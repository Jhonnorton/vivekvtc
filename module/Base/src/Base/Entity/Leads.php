<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Leads
 *
 * @ORM\Table(name="leads")
 * @ORM\Entity
 */
class Leads extends Base\BaseEntity
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
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    protected $type;
    
     
    
    /**
     * @var \Base\Entity\Avp\Affiliates
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\Avp\Affiliates")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="affiliate_id", referencedColumnName="id")
     * })
     */
    protected $affiliateId;

   
    /**
     * @var integer
     *
     * @ORM\Column(name="typename", type="integer",nullable=false)
     */
    protected $typename;

   
    /**
     * @var integer
     *
     * @ORM\Column(name="room_id", type="integer", nullable=false)
     */
    protected $roomId;
    
    
     /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name;
    
    
     /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    protected $email;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="phone", type="integer", nullable=false)
     */
    protected $phone;
    
    
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_from", type="date", nullable=false)
     */
    protected $dateFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_to", type="date", nullable=false)
     */
    protected $dateTo;
    
    
     /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255, nullable=false)
     */
    protected $subject;

 

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=false)
     */
    protected $message;

 

     /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    protected $status;
    
    
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date", nullable=true)
     */
    protected $createdAt;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="date", nullable=true)
     */
    protected $updatedAt;

    
    /**
     * @var integer
     *
     * @ORM\Column(name="reminder_type", type="integer", nullable=true)
     */
    protected $reminderType;
    
   /**
     * @var integer
     *
     * @ORM\Column(name="no_of_persons", type="integer", nullable=true)
     */
    protected $noOfPersons;
    
    
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="reminder_date", type="date", nullable=true)
     */
    protected $reminderDate;
    
    
      /**
     * @var string
     *
     * @ORM\Column(name="subject_reminder", type="string", length=255, nullable=true)
     */
    protected $subjectReminder;

 

    /**
     * @var string
     *
     * @ORM\Column(name="message_reminder", type="text", nullable=true)
     */
    protected $messageReminder;

    

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
     * Set type
     *
     * @param integer $type
     * @return Leads
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
     * Set typename
     *
     * @param string $typename
     * @return Leads
     */
    public function setTypename($typename)
    {
        $this->typename = $typename;

        return $this;
    }

    /**
     * Get typename
     *
     * @return string 
     */
    public function getTypename()
    {
        return $this->typename;
    }
    
     /**
     * Set roomId
     *
     * @param integer $roomId
     * @return Leads
     */
    public function setRoomId($roomId)
    {
        $this->roomId = $roomId;

        return $this;
    }
    
    
     /**
     * Get roomId
     *
     * @return integer 
     */
    public function getRoomId()
    {
        return $this->roomId;
    }
    
    
    
    /**
     * Set name
     *
     * @param string $name
     * @return Leads
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
     * Set email
     *
     * @param string $email
     * @return Leads
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
     * Set phone
     *
     * @param integer $phone
     * @return Leads
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return integer 
     */
    public function getPhone()
    {
        return $this->phone;
    }
   
   /**
     * Set noOfPersons
     *
     * @param integer $noOfPersons
     * @return Leads
     */
    public function setNoOfPersons($noOfPersons)
    {
        $this->noOfPersons = $noOfPersons;

        return $this;
    }

    /**
     * Get noOfPersons
     *
     * @return integer 
     */
    public function getNoOfPersons()
    {
        return $this->noOfPersons;
    }
  
   
    /**
     * Set dateFrom
     *
     * @param \DateTime $dateFrom
     * @return Leads
     */
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    /**
     * Get dateFrom
     *
     * @return \DateTime 
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * Set dateTo
     *
     * @param \DateTime $dateTo
     * @return Leads
     */
    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    /**
     * Get dateTo
     *
     * @return \DateTime 
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }
    
      /**
     * Set subject
     *
     * @param string $subject
     * @return Leads
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }
    
     /**
     * Set message
     *
     * @param string $message
     * @return Leads
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }
    
     /**
     * Set status
     *
     * @param integer $status
     * @return Leads
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
     * Set createdAt
     * 
     * @param \DateTime $createdAt
     * @return Leads
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    
     /**
     * Get createdAt
     *
     * @return \DateTime  
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Get updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Leads 
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
    
    /**
     * Get updatedAt
     *
     * @return \DateTime  
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    
    
     /**
     * Set reminderType
     *
     * @param integer $reminderType
     * @return Leads
     */
    public function setReminderType($reminderType)
    {
        $this->reminderType = $reminderType;

        return $this;
    }
    
    
     /**
     * Get reminderType
     *
     * @return integer 
     */
    public function getReminderType()
    {
        return $this->reminderType;
    }

    
     /**
     * Set reminderDate
     *
     * @param \DateTime $reminderDate
     * @return Leads
     */
    public function setReminderDate($reminderDate)
    {
        $this->reminderDate = $reminderDate;

        return $this;
    }

    /**
     * Get reminderDate
     *
     * @return \DateTime 
     */
    public function getReminderDate()
    {
        return $this->reminderDate;
    }
    
     /**
     * Set subjectReminder
     *
     * @param string $subjectReminder
     * @return Leads
     */
    public function setSubjectReminder($subjectReminder)
    {
        $this->subjectReminder = $subjectReminder;

        return $this;
    }

    /**
     * Get subjectReminder
     *
     * @return string 
     */
    public function getSubjectReminder()
    {
        return $this->subjectReminder;
    }
    
     /**
     * Set messageReminder
     *
     * @param string $messageReminder
     * @return Leads
     */
    public function setMessageReminder($messageReminder)
    {
        $this->messageReminder = $messageReminder;

        return $this;
    }

    /**
     * Get messageReminder
     *
     * @return string 
     */
    public function getmessageReminder()
    {
        return $this->messageReminder;
    }
    
    /**
     * Set affiliateId
     *
     * @param string $affiliateId
     * @return Leads
     */
    public function setAffiliateId($affiliateId)
    {
        $this->referenceNumber = $affiliateId;

        return $this;
    }

    /**
     * Get $affiliateId
     *
     * @return string 
     */
    public function getAffiliateId()
    {
        return $this->affiliateId;
    }
    

  
}
