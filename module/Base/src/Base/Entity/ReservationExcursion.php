<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationExcursion
 *
 * @ORM\Table(name="reservation_excursion")
 * @ORM\Entity
 */
class ReservationExcursion
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
     * @var \Base\Entity\InventoryExcursion
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\InventoryExcursion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="excursion_id", referencedColumnName="id")
     * })
     */
    private $excursion;

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
    public function setExcursion(\Base\Entity\InventoryExcursion $excursion = null)
    {
        $this->excursion = $excursion;

        return $this;
    }

    /**
     * Get item
     *
     * @return \Base\Entity\InventoryExcursion 
     */
    public function getExcursion()
    {
        return $this->excursion;
    }

    /**
     * Set reservation
     *
     * @param \Base\Entity\Reservation $reservation
     * @return ReservationExcursion
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
