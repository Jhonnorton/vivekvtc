<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationTransfer
 *
 * @ORM\Table(name="reservation_transfer")
 * @ORM\Entity
 */
class ReservationTransfer
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
     * @var \Base\Entity\InventoryTransfer
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\InventoryTransfer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="transfer_id", referencedColumnName="id")
     * })
     */
    private $transfer;

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
     * @param \Base\Entity\InventoryTransfer $transfer
     * @return ReservationTransfer
     */
    public function setTransfer(\Base\Entity\InventoryTransfer $transfer = null)
    {
        $this->transfer = $transfer;

        return $this;
    }

    /**
     * Get item
     *
     * @return \Base\Entity\InventoryTransfer 
     */
    public function getTransfer()
    {
        return $this->transfer;
    }

    /**
     * Set reservation
     *
     * @param \Base\Entity\Reservation $reservation
     * @return ReservationTransfer
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
