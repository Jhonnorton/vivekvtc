<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clients
 *
 * @ORM\Table(name="clients", indexes={@ORM\Index(name="FK_clients_countries_id", columns={"country_id"})})
 * @ORM\Entity
 */
class Clients extends Base\BaseEntity
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
     * @ORM\Column(name="first_name", type="string", length=64, nullable=false)
     */
    protected $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=64, nullable=false)
     */
    protected $lastName;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sex", type="boolean", nullable=false)
     */
    protected $sex;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=64, nullable=false)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=32, nullable=false)
     */
    protected $phone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dob", type="date", nullable=false)
     */
    protected $dob;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text", nullable=false)
     */
    protected $address;

    /**
     * @var string
     *
     * @ORM\Column(name="address2", type="text", nullable=false)
     */
    protected $address2;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=64, nullable=false)
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=64, nullable=false)
     */
    protected $state;

    /**
     * @var string
     *
     * @ORM\Column(name="zip", type="string", length=64, nullable=false)
     */
    protected $zip;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Clients
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
     * @return Clients
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
     * Set sex
     *
     * @param boolean $sex
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
     * @return boolean 
     */
    public function getSex()
    {
        return $this->sex;
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
     * Set address
     *
     * @param string $address
     * @return Clients
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
     * Set address2
     *
     * @param string $address2
     * @return Clients
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string 
     */
    public function getAddress2()
    {
        return $this->address2;
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
     * Set country
     *
     * @param \Base\Entity\Countries $country
     * @return Clients
     */
    public function setCountry(\Base\Entity\Countries $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Base\Entity\Countries 
     */
    public function getCountry()
    {
        return $this->country;
    }
}
