<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationCruiseCabin
 *
 * @ORM\Table(name="reservation_cruise_cabin", indexes={@ORM\Index(name="FK_reservation_cruise_cabin_reservation_id", columns={"reservation_id"}), @ORM\Index(name="FK_reservation_cruise_cabin_inventory_cruise_id", columns={"cabin_id"})})
 * @ORM\Entity
 */
class ReservationCruiseCabin
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
     * @var \Base\Entity\Avp\CruiseCabins
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\Avp\CruiseCabins")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cabin_id", referencedColumnName="id")
     * })
     */
    private $cabin;

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
     * Set cabin
     *
     * @param \Base\Entity\Avp\InventoryCruise $cabin
     * @return ReservationCruiseCabin
     */
    public function setCabin(\Base\Entity\Avp\CruiseCabins $cabin = null)
    {
        $this->cabin = $cabin;

        return $this;
    }

    /**
     * Get cabin
     *
     * @return \Base\Entity\Avp\InventoryCruise 
     */
    public function getCabin()
    {
        return $this->cabin;
    }

    /**
     * Set reservation
     *
     * @param \Base\Entity\Avp\Reservation $reservation
     * @return ReservationCruiseCabin
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
