<?php

namespace Base\Entity\Avp;
use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationResortRoom
 *
 * @ORM\Table(name="reservation_resort_room", indexes={@ORM\Index(name="FK_reservation_resort_room_inventory_hotels_id", columns={"room_id"}), @ORM\Index(name="FK_reservation_resort_room_reservation_id", columns={"reservation_id"})})
 * @ORM\Entity
 */
class ReservationResortRoom
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
     * @var \Base\Entity\Avp\Reservation
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Avp\Reservation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reservation_id", referencedColumnName="id")
     * })
     */
    protected $reservation;
    
    /**
     * @var \Base\Entity\Avp\ResortRooms
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Avp\ResortRooms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     * })
     */
    protected $room;



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
     * @param \Base\Entity\Avp\ResortRooms $room
     * @return ReservationResortRoom
     */
    public function setRoom(\Base\Entity\Avp\ResortRooms $room = null)
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
     * Set reservation
     *
     * @param \Base\Entity\Reservation $reservation
     * @return ReservationResortRoom
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
     * Set room
     *
     * @param \Base\Entity\ResortRooms $resortRoomId
     * @return ReservationResortRoom
     */
    public function setResortRoomId(\Base\Entity\Avp\ResortRooms $resortRoomId = null)
    {
        $this->resortRoomId = $resortRoomId;

        return $this;
    }

    /**
     * Get room
     *
     * @return \Base\Entity\ResortRooms $resortRoomId
     */
    public function getResortRoomId()
    {
        return $this->resortRoomId;
    }
}
