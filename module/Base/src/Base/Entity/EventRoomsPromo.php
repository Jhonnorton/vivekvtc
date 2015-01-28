<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventRoomsPromo
 *
 * @ORM\Table(name="event_rooms_promo", indexes={@ORM\Index(name="FK_event_rooms_promo_inventory_promo_id", columns={"promo_id"}), @ORM\Index(name="FK_event_rooms_promo_inventory_event_id", columns={"event_room_id"})})
 * @ORM\Entity
 */
class EventRoomsPromo extends Base\BaseEntity
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
     * @var \Base\Entity\InventoryEvent
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\InventoryEvent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event_room_id", referencedColumnName="id")
     * })
     */
    protected $eventRoom;

    /**
     * @var \Base\Entity\InventoryPromo
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\InventoryPromo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="promo_id", referencedColumnName="id")
     * })
     */
    protected $promo;



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
     * @param \Base\Entity\InventoryEvent $eventRoom
     * @return EventRoomsPromo
     */
    public function setEventRoom(\Base\Entity\InventoryEvent $eventRoom = null)
    {
        $this->eventRoom = $eventRoom;

        return $this;
    }

    /**
     * Get eventRoom
     *
     * @return \Base\Entity\InventoryEvent 
     */
    public function getEventRoom()
    {
        return $this->eventRoom;
    }

    /**
     * Set promo
     *
     * @param \Base\Entity\InventoryPromo $promo
     * @return EventRoomsPromo
     */
    public function setPromo(\Base\Entity\InventoryPromo $promo = null)
    {
        $this->promo = $promo;

        return $this;
    }

    /**
     * Get promo
     *
     * @return \Base\Entity\InventoryPromo 
     */
    public function getPromo()
    {
        return $this->promo;
    }
}
