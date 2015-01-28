<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * States
 *
 * @ORM\Table(name="states", indexes={@ORM\Index(name="fk_country to state", columns={"country_id"})})
 * @ORM\Entity
 */
class States extends Base\BaseEntity
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
     * @ORM\Column(name="state_name", type="string", length=64, nullable=false)
     */
    protected $stateName;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=4, nullable=false)
     */
    protected $code;

    /**
     * @var string
     *
     * @ORM\Column(name="search_name", type="string", length=64, nullable=true)
     */
    protected $searchName;

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
     * Set stateName
     *
     * @param string $stateName
     * @return States
     */
    public function setStateName($stateName)
    {
        $this->stateName = $stateName;

        return $this;
    }

    /**
     * Get stateName
     *
     * @return string 
     */
    public function getStateName()
    {
        return $this->stateName;
    }

    /**
     * Set code
     *
     * @param string $code
     * @return States
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
     * Set searchName
     *
     * @param string $searchName
     * @return States
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
     * Set country
     *
     * @param \Base\Entity\Countries $country
     * @return States
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
