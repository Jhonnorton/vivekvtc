<?php

namespace Base\Entity;

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
     * @var \Base\Entity\InventoryItem
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\InventoryItem")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="item_id", referencedColumnName="id")
     * })
     */
    private $item;

    /**
     * @var \Base\Entity\Reservation
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Reservation")
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
     * @param \Base\Entity\InventoryItem $item
     * @return ReservationItem
     */
    public function setItem(\Base\Entity\InventoryItem $item = null)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * Get item
     *
     * @return \Base\Entity\InventoryItem 
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * Set reservation
     *
     * @param \Base\Entity\Reservation $reservation
     * @return ReservationItem
     */
    public function setReservation(\Base\Entity\Reservation $reservation = null)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \Base\Entity\Reservation 
     */
    public function getReservation()
    {
        return $this->reservation;
    }
}
