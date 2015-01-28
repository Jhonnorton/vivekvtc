<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * Countries
 *
 * @ORM\Table(name="countries")
 * @ORM\Entity
 */
class Countries extends \Base\Entity\Base\BaseEntity
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
     * @ORM\Column(name="iso2", type="string", length=2, nullable=true)
     */
    protected $iso2;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=80, nullable=false)
     */
    protected $name = '';

    /**
     * @var string
     *
     * @ORM\Column(name="long_name", type="string", length=80, nullable=false)
     */
    protected $longName = '';

    /**
     * @var string
     *
     * @ORM\Column(name="iso3", type="string", length=3, nullable=true)
     */
    protected $iso3;

    /**
     * @var string
     *
     * @ORM\Column(name="numcode", type="string", length=6, nullable=true)
     */
    protected $numcode;

    /**
     * @var string
     *
     * @ORM\Column(name="un_member", type="string", length=12, nullable=true)
     */
    protected $unMember;

    /**
     * @var string
     *
     * @ORM\Column(name="calling_code", type="string", length=8, nullable=true)
     */
    protected $callingCode;

    /**
     * @var string
     *
     * @ORM\Column(name="cctld", type="string", length=5, nullable=true)
     */
    protected $cctld;



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
     * Set iso2
     *
     * @param string $iso2
     * @return Countries
     */
    public function setIso2($iso2)
    {
        $this->iso2 = $iso2;

        return $this;
    }

    /**
     * Get iso2
     *
     * @return string 
     */
    public function getIso2()
    {
        return $this->iso2;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Countries
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
     * Set longName
     *
     * @param string $longName
     * @return Countries
     */
    public function setLongName($longName)
    {
        $this->longName = $longName;

        return $this;
    }

    /**
     * Get longName
     *
     * @return string 
     */
    public function getLongName()
    {
        return $this->longName;
    }

    /**
     * Set iso3
     *
     * @param string $iso3
     * @return Countries
     */
    public function setIso3($iso3)
    {
        $this->iso3 = $iso3;

        return $this;
    }

    /**
     * Get iso3
     *
     * @return string 
     */
    public function getIso3()
    {
        return $this->iso3;
    }

    /**
     * Set numcode
     *
     * @param string $numcode
     * @return Countries
     */
    public function setNumcode($numcode)
    {
        $this->numcode = $numcode;

        return $this;
    }

    /**
     * Get numcode
     *
     * @return string 
     */
    public function getNumcode()
    {
        return $this->numcode;
    }

    /**
     * Set unMember
     *
     * @param string $unMember
     * @return Countries
     */
    public function setUnMember($unMember)
    {
        $this->unMember = $unMember;

        return $this;
    }

    /**
     * Get unMember
     *
     * @return string 
     */
    public function getUnMember()
    {
        return $this->unMember;
    }

    /**
     * Set callingCode
     *
     * @param string $callingCode
     * @return Countries
     */
    public function setCallingCode($callingCode)
    {
        $this->callingCode = $callingCode;

        return $this;
    }

    /**
     * Get callingCode
     *
     * @return string 
     */
    public function getCallingCode()
    {
        return $this->callingCode;
    }

    /**
     * Set cctld
     *
     * @param string $cctld
     * @return Countries
     */
    public function setCctld($cctld)
    {
        $this->cctld = $cctld;

        return $this;
    }

    /**
     * Get cctld
     *
     * @return string 
     */
    public function getCctld()
    {
        return $this->cctld;
    }
}
