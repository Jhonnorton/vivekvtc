<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CabinsPromo
 *
 * @ORM\Table(name="cabins_promo", indexes={@ORM\Index(name="FK_cabins_promo_inventory_promo_id", columns={"promo_id"}), @ORM\Index(name="FK_cabins_promo_inventory_cruise_id", columns={"cabin_id"})})
 * @ORM\Entity
 */
class CabinsPromo extends Base\BaseEntity
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
     * @var \Base\Entity\InventoryCruise
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\InventoryCruise")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cabin_id", referencedColumnName="id")
     * })
     */
    protected $cabin;

    /**
     * @var \Base\Entity\InventoryPromo
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\InventoryPromo")
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
     * Set cabin
     *
     * @param \Base\Entity\InventoryCruise $cabin
     * @return CabinsPromo
     */
    public function setCabin(\Base\Entity\InventoryCruise $cabin = null)
    {
        $this->cabin = $cabin;

        return $this;
    }

    /**
     * Get cabin
     *
     * @return \Base\Entity\InventoryCruise 
     */
    public function getCabin()
    {
        return $this->cabin;
    }

    /**
     * Set promo
     *
     * @param \Base\Entity\InventoryPromo $promo
     * @return CabinsPromo
     */
    public function setPromo(\Base\Entity\InventoryPromo $promo = null)
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
