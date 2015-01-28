<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * SubscriptionPlans
 *
 * @ORM\Table(name="subscription_plans")
 * @ORM\Entity
 */
class SubscriptionPlans
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
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var float
     *
     * @ORM\Column(name="cost", type="float", precision=10, scale=0, nullable=false)
     */
    private $cost;

    /**
     * @var float
     *
     * @ORM\Column(name="other_cost", type="float", precision=10, scale=0, nullable=false)
     */
    private $otherCost;

    /**
     * @var integer
     *
     * @ORM\Column(name="period", type="integer", nullable=false)
     */
    private $period;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_updated", type="datetime", nullable=true)
     */
    private $lastUpdated;



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
     * Set title
     *
     * @param string $title
     * @return SubscriptionPlans
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set cost
     *
     * @param float $cost
     * @return SubscriptionPlans
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }

    /**
     * Get cost
     *
     * @return float 
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set otherCost
     *
     * @param float $otherCost
     * @return SubscriptionPlans
     */
    public function setOtherCost($otherCost)
    {
        $this->otherCost = $otherCost;

        return $this;
    }

    /**
     * Get otherCost
     *
     * @return float 
     */
    public function getOtherCost()
    {
        return $this->otherCost;
    }

    /**
     * Set period
     *
     * @param integer $period
     * @return SubscriptionPlans
     */
    public function setPeriod($period)
    {
        $this->period = $period;

        return $this;
    }

    /**
     * Get period
     *
     * @return integer 
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Set lastUpdated
     *
     * @param \DateTime $lastUpdated
     * @return SubscriptionPlans
     */
    public function setLastUpdated($lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }

    /**
     * Get lastUpdated
     *
     * @return \DateTime 
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }
}
