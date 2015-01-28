<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationItem
 *
 * @ORM\Table(name="reservation_item", indexes={@ORM\Index(name="FK_reservation_item_reservation_id", columns={"reservation_id"}), @ORM\Index(name="FK_reservation_item_inventory_item_id", columns={"item_id"})})
 * @ORM\Entity
 */
class ReservationItem
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
     * @var \Base\Entity\Avp\InventoryItem
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Avp\InventoryItem")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     * })
     */
    private $item;

    /**
     * @var \Base\Entity\Avp\Reservation
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Avp\Reservation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reservation_id", referencedColumnName="id")
     * })
     */
    private $reservation;



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
     * Set item
     *
     * @param \Base\Entity\Avp\InventoryItem $item
     * @return ReservationItem
     */
    public function setItem(\Base\Entity\Avp\InventoryItem $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \Base\Entity\Avp\InventoryItem 
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set reservation
     *
     * @param \Base\Entity\Avp\Reservation $reservation
     * @return ReservationItem
     */
    public function setReservation(\Base\Entity\Avp\Reservation $reservation = null)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \Base\Entity\Avp\Reservation 
     */
    public function getReservation()
    {
        return $this->reservation;
    }
}
