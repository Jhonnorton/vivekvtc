<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PassangerDetails
 *
 * @ORM\Table(name="passanger_details", indexes={@ORM\Index(name="FK_passanger_details_orders_id", columns={"order_id"})})
 * @ORM\Entity
 */
class PassangerDetails extends Base\BaseEntity
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
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
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
     * @ORM\Column(name="email", type="string", length=50, nullable=true)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="string", length=50, nullable=true)
     */
    protected $contact;

    /**
     * @var boolean
     *
     * @ORM\Column(name="age", type="boolean", nullable=true)
     */
    protected $age;

    /**
     * @var \Base\Entity\Orders
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Orders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     * })
     */
    protected $order;



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
     * Set name
     *
     * @param string $name
     * @return PassangerDetails
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
     * @return PassangerDetails
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
     * @return PassangerDetails
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
     * Set contact
     *
     * @param string $contact
     * @return PassangerDetails
     */
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return string 
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set age
     *
     * @param boolean $age
     * @return PassangerDetails
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return boolean 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set order
     *
     * @param \Base\Entity\Orders $order
     * @return PassangerDetails
     */
    public function setOrder(\Base\Entity\Orders $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Base\Entity\Orders 
     */
    public function getOrder()
    {
        return $this->order;
    }
}
