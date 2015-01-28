<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * CruisePromo
 *
 * @ORM\Table(name="cruise_promo", indexes={@ORM\Index(name="FK_cruise_promo_inventory_promo_id", columns={"promo_id"})})
 * @ORM\Entity
 */
class CruisePromo
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
     * @ORM\Column(name="cruise_id", type="integer", nullable=false)
     */
    protected $cruiseId;

    /**
     * @var \Base\Entity\Avp\InventoryPromo
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Avp\InventoryPromo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="promo_id", referencedColumnName="id")
     * })
     */
    protected $promo;



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
     * Set cruiseId
     *
     * @param integer $cruiseId
     * @return CruisePromo
     */
    public function setCruiseId($cruiseId)
    {
        $this->cruiseId = $cruiseId;

        return $this;
    }

    /**
     * Get cruiseId
     *
     * @return integer 
     */
    public function getCruiseId()
    {
        return $this->cruiseId;
    }

    /**
     * Set promo
     *
     * @param \Base\Entity\InventoryPromo $promo
     * @return CruisePromo
     */
    public function setPromo(\Base\Entity\Avp\InventoryPromo $promo = null)
    {
        $this->promo = $promo;

        return $this;
    }

    /**
     * Get promo
     *
     * @return \Base\Entity\InventoryPromo 
     */
    public function getPromo()
    {
        return $this->promo;
    }
}
