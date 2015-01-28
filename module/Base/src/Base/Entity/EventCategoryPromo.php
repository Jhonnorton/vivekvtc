<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventCategoryPromo
 *
 * @ORM\Table(name="event_category_promo", indexes={@ORM\Index(name="FK_event_category_promo_inventory_promo_id", columns={"promo_id"})})
 * @ORM\Entity
 */
class EventCategoryPromo extends Base\BaseEntity
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
     * @var integer
     *
     * @ORM\Column(name="event_category_id", type="integer", nullable=false)
     */
    protected $eventCategoryId;

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
     * Set eventCategoryId
     *
     * @param integer $eventCategoryId
     * @return EventCategoryPromo
     */
    public function setEventCategoryId($eventCategoryId)
    {
        $this->eventCategoryId = $eventCategoryId;

        return $this;
    }

    /**
     * Get eventCategoryId
     *
     * @return integer 
     */
    public function getEventCategoryId()
    {
        return $this->eventCategoryId;
    }

    /**
     * Set promo
     *
     * @param \Base\Entity\InventoryPromo $promo
     * @return EventCategoryPromo
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
