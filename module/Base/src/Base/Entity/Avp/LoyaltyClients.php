<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * LoyaltyClients
 *
 * @ORM\Table(name="loyalty_clients")
 * @ORM\Entity
 */
class LoyaltyClients
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
     * @ORM\Column(name="client_id", type="integer", nullable=false)
     */
    private $clientId;

    /**
     * @var integer
     *
     * @ORM\Column(name="points_total", type="integer", nullable=false)
     */
    private $pointsTotal;

    /**
     * @var integer
     *
     * @ORM\Column(name="points_redeemed", type="integer", nullable=false)
     */
    private $pointsRedeemed;

    /**
     * @var float
     *
     * @ORM\Column(name="discount", type="float", precision=10, scale=0, nullable=false)
     */
    private $discount;

    /**
     * @var string
     *
     * @ORM\Column(name="discount_key", type="string", length=255, nullable=true)
     */
    private $discountKey;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime", nullable=false)
     */
    private $dateAdded;



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
     * Set clientId
     *
     * @param integer $clientId
     * @return LoyaltyClients
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get clientId
     *
     * @return integer 
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set pointsTotal
     *
     * @param integer $pointsTotal
     * @return LoyaltyClients
     */
    public function setPointsTotal($pointsTotal)
    {
        $this->pointsTotal = $pointsTotal;

        return $this;
    }

    /**
     * Get pointsTotal
     *
     * @return integer 
     */
    public function getPointsTotal()
    {
        return $this->pointsTotal;
    }

    /**
     * Set pointsRedeemed
     *
     * @param integer $pointsRedeemed
     * @return LoyaltyClients
     */
    public function setPointsRedeemed($pointsRedeemed)
    {
        $this->pointsRedeemed = $pointsRedeemed;

        return $this;
    }

    /**
     * Get pointsRedeemed
     *
     * @return integer 
     */
    public function getPointsRedeemed()
    {
        return $this->pointsRedeemed;
    }

    /**
     * Set discount
     *
     * @param float $discount
     * @return LoyaltyClients
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return float 
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set discountKey
     *
     * @param string $discountKey
     * @return LoyaltyClients
     */
    public function setDiscountKey($discountKey)
    {
        $this->discountKey = $discountKey;

        return $this;
    }

    /**
     * Get discountKey
     *
     * @return string 
     */
    public function getDiscountKey()
    {
        return $this->discountKey;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return LoyaltyClients
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime 
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }
}
