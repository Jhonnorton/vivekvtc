<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventCommissions
 *
 * @ORM\Table(name="event_commissions")
 * @ORM\Entity
 */
class EventCommissions
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
     * @ORM\Column(name="event_id", type="integer", nullable=false)
     */
    private $eventId;

    /**
     * @var integer
     *
     * @ORM\Column(name="commission_id", type="integer", nullable=false)
     */
    private $commissionId;



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
     * Set eventId
     *
     * @param integer $eventId
     * @return EventCommissions
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

    /**
     * Set commissionId
     *
     * @param integer $commissionId
     * @return EventCommissions
     */
    public function setCommissionId($commissionId)
    {
        $this->commissionId = $commissionId;

        return $this;
    }

    /**
     * Get commissionId
     *
     * @return integer 
     */
    public function getCommissionId()
    {
        return $this->commissionId;
    }
}
