<?php

namespace Base\Entity\Avp;

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
     * @var \Base\Entity\Avp\InventoryExcursion
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Avp\InventoryExcursion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="excursion_id", referencedColumnName="id")
     * })
     */
    private $excursion;

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
    public function setExcursion(\Base\Entity\Avp\InventoryExcursion $excursion = null)
    {
        $this->excursion = $excursion;

        return $this;
    }

    /**
     * Get item
     *
     * @return \Base\Entity\Avp\InventoryExcursion 
     */
    public function getExcursion()
    {
        return $this->excursion;
    }

    /**
     * Set reservation
     *
     * @param \Base\Entity\Avp\Reservation $reservation
     * @return ReservationExcursion
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
