<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventAdminCommissions
 *
 * @ORM\Table(name="event_admin_commissions")
 * @ORM\Entity
 */
class EventAdminCommissions
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
     * @ORM\Column(name="order_id", type="integer", nullable=false)
     */
    private $orderId;

    /**
     * @var string
     *
     * @ORM\Column(name="event_name", type="string", length=200, nullable=false)
     */
    private $eventName;

    /**
     * @var float
     *
     * @ORM\Column(name="commission", type="float", precision=10, scale=0, nullable=false)
     */
    private $commission;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added_on", type="date", nullable=false)
     */
    private $addedOn;



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
     * Set orderId
     *
     * @param integer $orderId
     * @return EventAdminCommissions
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return integer 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set eventName
     *
     * @param string $eventName
     * @return EventAdminCommissions
     */
    public function setEventName($eventName)
    {
        $this->eventName = $eventName;

        return $this;
    }

    /**
     * Get eventName
     *
     * @return string 
     */
    public function getEventName()
    {
        return $this->eventName;
    }

    /**
     * Set commission
     *
     * @param float $commission
     * @return EventAdminCommissions
     */
    public function setCommission($commission)
    {
        $this->commission = $commission;

        return $this;
    }

    /**
     * Get commission
     *
     * @return float 
     */
    public function getCommission()
    {
        return $this->commission;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return EventAdminCommissions
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set addedOn
     *
     * @param \DateTime $addedOn
     * @return EventAdminCommissions
     */
    public function setAddedOn($addedOn)
    {
        $this->addedOn = $addedOn;

        return $this;
    }

    /**
     * Get addedOn
     *
     * @return \DateTime 
     */
    public function getAddedOn()
    {
        return $this->addedOn;
    }
}
