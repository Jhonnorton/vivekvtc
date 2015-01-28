<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Countries
 *
 * @ORM\Table(name="countries")
 * @ORM\Entity
 */
class Countries extends Base\BaseEntity
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
     * @ORM\Column(name="calling_code", type="string", length=4, nullable=false)
     */
 
    protected $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     */
    protected $countryName;

    /**
     * @var string
     *
     * @ORM\Column(name="iso3", type="string", length=3, nullable=true)
     */
    protected $currency;

    /**
     * @var string
     *
     * @ORM\Column(name="long_name", type="string", length=128, nullable=true)
     */
    protected $searchName;


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
     * Set code
     *
     * @param string $code
     * @return Countries
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string 
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set countryName
     *
     * @param string $countryName
     * @return Countries
     */
    public function setCountryName($countryName)
    {
        $this->countryName = $countryName;

        return $this;
    }

    /**
     * Get countryName
     *
     * @return string 
     */
    public function getCountryName()
    {
        return $this->countryName;
    }

    /**
     * Set currency
     *
     * @param string $currency
     * @return Countries
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set searchName
     *
     * @param string $searchName
     * @return Countries
     */
    public function setSearchName($searchName)
    {
        $this->searchName = $searchName;

        return $this;
    }

    /**
     * Get searchName
     *
     * @return string 
     */
    public function getSearchName()
    {
        return $this->searchName;
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
