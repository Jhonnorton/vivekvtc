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
    public function setUpdatedAt()
    {
        return $this->updatedAt;
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


  
}
