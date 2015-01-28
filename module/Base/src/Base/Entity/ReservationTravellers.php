<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationTravellers
 *
 * @ORM\Table(name="reservation_travellers", indexes={@ORM\Index(name="FK_reservation_travellers_travellers_id", columns={"traveller_id"}), @ORM\Index(name="FK_reservation_travellers_reservation_id", columns={"reservation_id"})})
 * @ORM\Entity
 */
class ReservationTravellers
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
     * @var \Base\Entity\Reservation
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Reservation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reservation_id", referencedColumnName="id")
     * })
     */
    private $reservation;

    /**
     * @var \Base\Entity\Travellers
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Travellers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="traveller_id", referencedColumnName="id")
     * })
     */
    private $traveller;



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
     * Set reservation
     *
     * @param \Base\Entity\Reservation $reservation
     * @return ReservationTravellers
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

    /**
     * Set traveller
     *
     * @param \Base\Entity\Travellers $traveller
     * @return ReservationTravellers
     */
    public function setTraveller(\Base\Entity\Travellers $traveller = null)
    {
        $this->traveller = $traveller;

        return $this;
    }

    /**
     * Get traveller
     *
     * @return \Base\Entity\Travellers 
     */
    public function getTraveller()
    {
        return $this->traveller;
    }
}
