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
}
