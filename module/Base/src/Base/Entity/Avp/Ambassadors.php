<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ambassadors
 *
 * @ORM\Table(name="ambassadors")
 * @ORM\Entity
 */
class Ambassadors
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
     * @ORM\Column(name="first_name", type="string", length=128, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=64, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=64, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=24, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text", nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="text", nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=128, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="thumbnail", type="string", length=128, nullable=true)
     */
    private $thumbnail;

    /**
     * @var string
     *
     * @ORM\Column(name="uin_id", type="string", length=32, nullable=false)
     */
    private $uinId;

    /**
     * @var string
     *
     * @ORM\Column(name="uin_url", type="string", length=128, nullable=false)
     */
    private $uinUrl;

    /**
     * @var integer
     *
     * @ORM\Column(name="points_pending", type="integer", nullable=true)
     */
    private $pointsPending;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_points", type="integer", nullable=true)
     */
    private $totalPoints = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="discount", type="integer", nullable=true)
     */
    private $discount;



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
     * @return Ambassadors
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
     * @return Ambassadors
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
     * Set email
     *
     * @param string $email
     * @return Ambassadors
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
     * @return Ambassadors
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
     * Set address
     *
     * @param string $address
     * @return Ambassadors
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
     * Set city
     *
     * @param string $city
     * @return Ambassadors
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
     * Set image
     *
     * @param string $image
     * @return Ambassadors
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
     * Set thumbnail
     *
     * @param string $thumbnail
     * @return Ambassadors
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    /**
     * Get thumbnail
     *
     * @return string 
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * Set uinId
     *
     * @param string $uinId
     * @return Ambassadors
     */
    public function setUinId($uinId)
    {
        $this->uinId = $uinId;

        return $this;
    }

    /**
     * Get uinId
     *
     * @return string 
     */
    public function getUinId()
    {
        return $this->uinId;
    }

    /**
     * Set uinUrl
     *
     * @param string $uinUrl
     * @return Ambassadors
     */
    public function setUinUrl($uinUrl)
    {
        $this->uinUrl = $uinUrl;

        return $this;
    }

    /**
     * Get uinUrl
     *
     * @return string 
     */
    public function getUinUrl()
    {
        return $this->uinUrl;
    }

    /**
     * Set pointsPending
     *
     * @param integer $pointsPending
     * @return Ambassadors
     */
    public function setPointsPending($pointsPending)
    {
        $this->pointsPending = $pointsPending;

        return $this;
    }

    /**
     * Get pointsPending
     *
     * @return integer 
     */
    public function getPointsPending()
    {
        return $this->pointsPending;
    }

    /**
     * Set totalPoints
     *
     * @param integer $totalPoints
     * @return Ambassadors
     */
    public function setTotalPoints($totalPoints)
    {
        $this->totalPoints = $totalPoints;

        return $this;
    }

    /**
     * Get totalPoints
     *
     * @return integer 
     */
    public function getTotalPoints()
    {
        return $this->totalPoints;
    }

    /**
     * Set discount
     *
     * @param integer $discount
     * @return Ambassadors
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return integer 
     */
    public function getDiscount()
    {
        return $this->discount;
    }
}
