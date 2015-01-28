<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResortPromo
 *
 * @ORM\Table(name="resort_promo", indexes={@ORM\Index(name="FK_resort_promo_inventory_promo_id", columns={"promo_id"})})
 * @ORM\Entity
 */
class ResortPromo extends Base\BaseEntity
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
     * @ORM\Column(name="resort_id", type="integer", nullable=false)
     */
    protected $resortId;

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
     * Set resortId
     *
     * @param integer $resortId
     * @return ResortPromo
     */
    public function setResortId($resortId)
    {
        $this->resortId = $resortId;

        return $this;
    }

    /**
     * Get resortId
     *
     * @return integer 
     */
    public function getResortId()
    {
        return $this->resortId;
    }

    /**
     * Set promo
     *
     * @param \Base\Entity\InventoryPromo $promo
     * @return ResortPromo
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
