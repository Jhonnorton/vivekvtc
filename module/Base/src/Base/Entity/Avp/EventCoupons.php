<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventCoupons
 *
 * @ORM\Table(name="event_coupons")
 * @ORM\Entity
 */
class EventCoupons
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
     * @var integer
     *
     * @ORM\Column(name="coupon_id", type="integer", nullable=false)
     */
    private $couponId;

    /**
     * @var integer
     *
     * @ORM\Column(name="event_id", type="integer", nullable=false)
     */
    private $eventId;



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
     * Set couponId
     *
     * @param integer $couponId
     * @return EventCoupons
     */
    public function setCouponId($couponId)
    {
        $this->couponId = $couponId;

        return $this;
    }

    /**
     * Get couponId
     *
     * @return integer 
     */
    public function getCouponId()
    {
        return $this->couponId;
    }

    /**
     * Set eventId
     *
     * @param integer $eventId
     * @return EventCoupons
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return integer 
     */
    public function getEventId()
    {
        return $this->eventId;
    }
}
