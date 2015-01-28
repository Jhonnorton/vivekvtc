<?php

namespace Base\Entity\Avp;

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
     * @var \Base\Entity\Avp\InventoryTransfer
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Avp\InventoryTransfer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="transfer_id", referencedColumnName="id")
     * })
     */
    private $transfer;

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
     * @param \Base\Entity\Avp\InventoryTransfer $transfer
     * @return ReservationTransfer
     */
    public function setTransfer(\Base\Entity\Avp\InventoryTransfer $transfer = null)
    {
        $this->transfer = $transfer;

        return $this;
    }

    /**
     * Get item
     *
     * @return \Base\Entity\Avp\InventoryTransfer 
     */
    public function getTransfer()
    {
        return $this->transfer;
    }

    /**
     * Set reservation
     *
     * @param \Base\Entity\Avp\Reservation $reservation
     * @return ReservationTransfer
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
