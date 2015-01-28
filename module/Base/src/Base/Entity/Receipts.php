<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TravellerNotes
 *
 * @ORM\Table(name="receipts")
 * @ORM\Entity
 */
class Receipts extends Base\BaseEntity
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
     * @ORM\Column(name="name", type="string", nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     */
    protected $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=600, nullable=true)
     */
    protected $address;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string",length=255, nullable=true)
     */
    protected $city;
    

    /**
     * @var string
     *
     * @ORM\Column(name="suite", type="string", length=255, nullable=true)
     */
    protected $suite;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255, nullable=true)
     */
    protected $state;

    /**
     * @var integer
     *
     * @ORM\Column(name="country", type="integer", length=11, nullable=true)
     */
    protected $country;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="zip", type="integer", nullable=true)
     */
    protected $zip;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_received", type="integer", nullable=true)
     */
    protected $total_received;

    /**
     * @var integer
     *
     * @ORM\Column(name="for_type", type="integer",  nullable=true)
     */
    protected $for_type;

    /**
     * @var integer
     *
     * @ORM\Column(name="for_id", type="integer", nullable=true)
     */
    protected $for_id;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="mail_status", type="integer", nullable=true)
     */
    protected $mail_status;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string",  nullable=true)
     */
    protected $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="date", nullable=true)
     */
    protected $created_at;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    protected $date;
   



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
     * Set Receipient name
     *
     * @param integer $travellerId
     * @return Receipts
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Receipient name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set Receipient email
     *
     * @param string $email
     * @return Receipt
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get Receipient email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set Receipient phone
     *
     * @param string $phone
     * @return Receipts
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get Receipient phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set Receipient address
     *
     * @param string $address
     * @return Receipts
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }
    
    /**
     * Set Receipient suite
     *
     * @param string $suite
     * @return Receipts
     */
    public function setSuite($suite)
    {
        $this->suite = $suite;

        return $this;
    }

    /**
     * Get Receipient suite
     *
     * @return string 
     */
    public function getSuite()
    {
        return $this->suite;
    }
    
    /**
     * Set Receipient city
     *
     * @param string $city
     * @return Receipts
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get Receipient city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }
    
    /**
     * Set Receipient state
     *
     * @param string $state
     * @return Receipts
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get Receipient state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }
    
    /**
     * Set Receipient country
     *
     * @param integer $country
     * @return Receipts
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get Receipient country
     *
     * @return integer 
     */
    public function getCountry()
    {
        return $this->country;
    }
    
    
    /**
     * Set Receipient zip
     *
     * @param integer $zip
     * @return Receipts
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get Receipient zip
     *
     * @return integer 
     */
    public function getZip()
    {
        return $this->zip;
    }
    
    /**
     * Set Receipient total_received
     *
     * @param integer $total_received
     * @return Receipts
     */
    public function setTotalReceived($total_received)
    {
        $this->total_received = $total_received;

        return $this;
    }

    /**
     * Get Receipient total_received
     *
     * @return integer 
     */
    public function getTotalReceived()
    {
        return $this->total_received;
    }
    
    /**
     * Set Receipient for_type
     *
     * @param integer $for_type
     * @return Receipts
     */
    public function setForType($for_type)
    {
        $this->for_type = $for_type;

        return $this;
    }

    /**
     * Get Receipient for_type
     *
     * @return integer 
     */
    public function getForType()
    {
        return $this->for_type;
    }
    
    /**
     * Set Receipient for_id
     *
     * @param integer $for_id
     * @return Receipts
     */
    public function setForId($for_id)
    {
        $this->for_id = $for_id;

        return $this;
    }

    /**
     * Get Receipient for_id
     *
     * @return integer 
     */
    public function getForId()
    {
        return $this->for_id;
    }

    
    /**
     * Set Receipient mail_status
     *
     * @param integer $mail_status
     * @return Receipts
     */
    public function setMailStatus($mail_status)
    {
        $this->mail_status = $mail_status;

        return $this;
    }

    /**
     * Get Receipient mail_status
     *
     * @return integer 
     */
    public function getMailStatus()
    {
        return $this->mail_status;
    }
    
    /**
     * Set Receipient description
     *
     * @param string $description
     * @return Receipts
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get Receipient description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    
    /**
     * Set Receipient created_at
     *
     * @param \DateTime $created_at
     * @return Receipts
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * Get Receipient created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    
    /**
     * Set Receipient date
     *
     * @param \DateTime $date
     * @return Receipts
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get Receipient date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
   
}
