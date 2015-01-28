<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserOrders
 *
 * @ORM\Table(name="user_orders")
 * @ORM\Entity
 */
class UserOrders
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
     * @var string
     *
     * @ORM\Column(name="item_name", type="string", length=256, nullable=false)
     */
    private $itemName;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=128, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=32, nullable=false)
     */
    private $phone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_from", type="date", nullable=false)
     */
    private $dateFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_to", type="date", nullable=false)
     */
    private $dateTo;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_of_travels", type="integer", nullable=false)
     */
    private $numberOfTravels;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text", nullable=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_method", type="string", length=32, nullable=false)
     */
    private $contactMethod;

    /**
     * @var string
     *
     * @ORM\Column(name="callback_time", type="string", length=32, nullable=true)
     */
    private $callbackTime;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="string", length=32, nullable=false)
     */
    private $price;



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
     * Set itemName
     *
     * @param string $itemName
     * @return UserOrders
     */
    public function setItemName($itemName)
    {
        $this->itemName = $itemName;

        return $this;
    }

    /**
     * Get itemName
     *
     * @return string 
     */
    public function getItemName()
    {
        return $this->itemName;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return UserOrders
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
     * @return UserOrders
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
     * @param string $phone
     * @return UserOrders
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
     * Set dateFrom
     *
     * @param \DateTime $dateFrom
     * @return UserOrders
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
     * @return UserOrders
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
     * Set numberOfTravels
     *
     * @param integer $numberOfTravels
     * @return UserOrders
     */
    public function setNumberOfTravels($numberOfTravels)
    {
        $this->numberOfTravels = $numberOfTravels;

        return $this;
    }

    /**
     * Get numberOfTravels
     *
     * @return integer 
     */
    public function getNumberOfTravels()
    {
        return $this->numberOfTravels;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return UserOrders
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
     * Set contactMethod
     *
     * @param string $contactMethod
     * @return UserOrders
     */
    public function setContactMethod($contactMethod)
    {
        $this->contactMethod = $contactMethod;

        return $this;
    }

    /**
     * Get contactMethod
     *
     * @return string 
     */
    public function getContactMethod()
    {
        return $this->contactMethod;
    }

    /**
     * Set callbackTime
     *
     * @param string $callbackTime
     * @return UserOrders
     */
    public function setCallbackTime($callbackTime)
    {
        $this->callbackTime = $callbackTime;

        return $this;
    }

    /**
     * Get callbackTime
     *
     * @return string 
     */
    public function getCallbackTime()
    {
        return $this->callbackTime;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return UserOrders
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }
}
