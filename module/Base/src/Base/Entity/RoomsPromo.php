<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RoomsPromo
 *
 * @ORM\Table(name="rooms_promo", indexes={@ORM\Index(name="FK_rooms_promo_inventory_promo_id", columns={"promo_id"}), @ORM\Index(name="FK_rooms_promo_inventory_hotels_id", columns={"room_id"})})
 * @ORM\Entity
 */
class RoomsPromo extends Base\BaseEntity
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
     * @var \Base\Entity\InventoryHotels
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\InventoryHotels")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     * })
     */
    protected $room;

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
     * Set room
     *
     * @param \Base\Entity\InventoryHotels $room
     * @return RoomsPromo
     */
    public function setRoom(\Base\Entity\InventoryHotels $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \Base\Entity\InventoryHotels 
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set promo
     *
     * @param \Base\Entity\InventoryPromo $promo
     * @return RoomsPromo
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
