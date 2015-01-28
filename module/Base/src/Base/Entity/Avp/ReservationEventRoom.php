<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationEventRoom
 *
 * @ORM\Table(name="reservation_event_room", indexes={@ORM\Index(name="FK_reservation_event_room_reservation_id", columns={"reservation_id"}), @ORM\Index(name="FK_reservation_event_room_inventory_event_id", columns={"event_room_id"})})
 * @ORM\Entity
 */
class ReservationEventRoom
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
     * @var \Base\Entity\Avp\EventRooms
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Avp\EventRooms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event_room_id", referencedColumnName="id")
     * })
     */
    private $eventRoom;

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
     * Set eventRoom
     *
     * @param \Base\Entity\Avp\EventRooms $eventRoom
     * @return ReservationEventRoom
     */
    public function setEventRoom(\Base\Entity\Avp\EventRooms $eventRoom = null)
    {
        $this->eventRoom = $eventRoom;

        return $this;
    }

    /**
     * Get eventRoom
     *
     * @return \Base\Entity\Avp\EventRooms 
     */
    public function getEventRoom()
    {
        return $this->eventRoom;
    }

    /**
     * Set reservation
     *
     * @param \Base\Entity\Avp\Reservation $reservation
     * @return ReservationEventRoom
     */
    public function setReservation(\Base\Entity\Reservation $reservation = null)
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
