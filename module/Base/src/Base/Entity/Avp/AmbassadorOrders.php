<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * AmbassadorOrders
 *
 * @ORM\Table(name="ambassador_orders")
 * @ORM\Entity
 */
class AmbassadorOrders
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
     * @ORM\Column(name="ambassador_id", type="integer", nullable=false)
     */
    private $ambassadorId;

    /**
     * @var integer
     *
     * @ORM\Column(name="customer_id", type="integer", nullable=false)
     */
    private $customerId;

    /**
     * @var integer
     *
     * @ORM\Column(name="order_id", type="integer", nullable=false)
     */
    private $orderId;

    /**
     * @var integer
     *
     * @ORM\Column(name="points", type="integer", nullable=false)
     */
    private $points;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;



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
     * Set ambassadorId
     *
     * @param integer $ambassadorId
     * @return AmbassadorOrders
     */
    public function setAmbassadorId($ambassadorId)
    {
        $this->ambassadorId = $ambassadorId;

        return $this;
    }

    /**
     * Get ambassadorId
     *
     * @return integer 
     */
    public function getAmbassadorId()
    {
        return $this->ambassadorId;
    }

    /**
     * Set customerId
     *
     * @param integer $customerId
     * @return AmbassadorOrders
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return integer 
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set orderId
     *
     * @param integer $orderId
     * @return AmbassadorOrders
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
     * Set points
     *
     * @param integer $points
     * @return AmbassadorOrders
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return integer 
     */
    public function getPoints()
    {
        return $this->points;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return AmbassadorOrders
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }
}
