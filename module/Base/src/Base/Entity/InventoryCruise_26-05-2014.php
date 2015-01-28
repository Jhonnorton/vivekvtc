<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InventoryCruise
 *
 * @ORM\Table(name="inventory_cruise", indexes={@ORM\Index(name="FK_inventory_cruise_inventory_promo_id", columns={"promo_id"})})
 * @ORM\Entity
 */
class InventoryCruise extends Base\BaseEntity
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
     * @ORM\Column(name="cruise_id", type="integer", nullable=false)
     */
    protected $cruiseId;

    /**
     * @var integer
     *
     * @ORM\Column(name="suite_id", type="integer", nullable=false)
     */
    protected $suiteId;

    /**
     * @var string
     *
     * @ORM\Column(name="cruise_name", type="string", length=128, nullable=false)
     */
    protected $cruiseName;

    /**
     * @var integer
     *
     * @ORM\Column(name="deck_number", type="integer", nullable=false)
     */
    protected $deckNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="suite_name", type="string", length=128, nullable=false)
     */
    protected $suiteName;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_available", type="integer", nullable=false)
     */
    protected $totalAvailable = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_from", type="date", nullable=false)
     */
    protected $dateFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_to", type="date", nullable=false)
     */
    protected $dateTo;

    /**
     * @var string
     *
     * @ORM\Column(name="net_price", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $netPrice = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="gross_price", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $grossPrice = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="text", nullable=true)
     */
    protected $notes;

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
     * Set cruiseId
     *
     * @param integer $cruiseId
     * @return InventoryCruise
     */
    public function setCruiseId($cruiseId)
    {
        $this->cruiseId = $cruiseId;

        return $this;
    }

    /**
     * Get cruiseId
     *
     * @return integer 
     */
    public function getCruiseId()
    {
        return $this->cruiseId;
    }

    /**
     * Set suiteId
     *
     * @param integer $suiteId
     * @return InventoryCruise
     */
    public function setSuiteId($suiteId)
    {
        $this->suiteId = $suiteId;

        return $this;
    }

    /**
     * Get suiteId
     *
     * @return integer 
     */
    public function getSuiteId()
    {
        return $this->suiteId;
    }

    /**
     * Set cruiseName
     *
     * @param string $cruiseName
     * @return InventoryCruise
     */
    public function setCruiseName($cruiseName)
    {
        $this->cruiseName = $cruiseName;

        return $this;
    }

    /**
     * Get cruiseName
     *
     * @return string 
     */
    public function getCruiseName()
    {
        return $this->cruiseName;
    }

    /**
     * Set deckNumber
     *
     * @param integer $deckNumber
     * @return InventoryCruise
     */
    public function setDeckNumber($deckNumber)
    {
        $this->deckNumber = $deckNumber;

        return $this;
    }

    /**
     * Get deckNumber
     *
     * @return integer 
     */
    public function getDeckNumber()
    {
        return $this->deckNumber;
    }

    /**
     * Set suiteName
     *
     * @param string $suiteName
     * @return InventoryCruise
     */
    public function setSuiteName($suiteName)
    {
        $this->suiteName = $suiteName;

        return $this;
    }

    /**
     * Get suiteName
     *
     * @return string 
     */
    public function getSuiteName()
    {
        return $this->suiteName;
    }

    /**
     * Set totalAvailable
     *
     * @param integer $totalAvailable
     * @return InventoryCruise
     */
    public function setTotalAvailable($totalAvailable)
    {
        $this->totalAvailable = $totalAvailable;

        return $this;
    }

    /**
     * Get totalAvailable
     *
     * @return integer 
     */
    public function getTotalAvailable()
    {
        return $this->totalAvailable;
    }

    /**
     * Set dateFrom
     *
     * @param \DateTime $dateFrom
     * @return InventoryCruise
     */
    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;

        return $this;
    }

    /**
     * Get dateFrom
     *
     * @return \DateTime 
     */
    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    /**
     * Set dateTo
     *
     * @param \DateTime $dateTo
     * @return InventoryCruise
     */
    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;

        return $this;
    }

    /**
     * Get dateTo
     *
     * @return \DateTime 
     */
    public function getDateTo()
    {
        return $this->dateTo;
    }

    /**
     * Set netPrice
     *
     * @param string $netPrice
     * @return InventoryCruise
     */
    public function setNetPrice($netPrice)
    {
        $this->netPrice = $netPrice;

        return $this;
    }

    /**
     * Get netPrice
     *
     * @return string 
     */
    public function getNetPrice()
    {
        return $this->netPrice;
    }

    /**
     * Set grossPrice
     *
     * @param string $grossPrice
     * @return InventoryCruise
     */
    public function setGrossPrice($grossPrice)
    {
        $this->grossPrice = $grossPrice;

        return $this;
    }

    /**
     * Get grossPrice
     *
     * @return string 
     */
    public function getGrossPrice()
    {
        return $this->grossPrice;
    }

    /**
     * Set notes
     *
     * @param string $notes
     * @return InventoryCruise
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

    /**
     * Get notes
     *
     * @return string 
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * Set promo
     *
     * @param \Base\Entity\InventoryPromo $promo
     * @return InventoryCruise
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
