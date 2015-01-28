<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InventoryHotels
 *
 * @ORM\Table(name="inventory_hotels", indexes={@ORM\Index(name="FK_inventory_hotels_inventory_promo_id", columns={"promo_id"})})
 * @ORM\Entity
 */
class InventoryHotels extends Base\BaseEntity
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
     * @ORM\Column(name="resort_id", type="integer", nullable=false)
     */
    protected $resortId;

    /**
     * @var integer
     *
     * @ORM\Column(name="room_id", type="integer", nullable=false)
     */
    protected $roomId;

    /**
     * @var string
     *
     * @ORM\Column(name="hotel_name", type="string", length=128, nullable=false)
     */
    protected $hotelName;

    /**
     * @var string
     *
     * @ORM\Column(name="room_category", type="string", length=255, nullable=false)
     */
    protected $roomCategory;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_available", type="integer", nullable=false)
     */
    protected $numberAvailable;

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
     * Set resortId
     *
     * @param integer $resortId
     * @return InventoryHotels
     */
    public function setResortId($resortId)
    {
        $this->resortId = $resortId;

        return $this;
    }

    /**
     * Get resortId
     *
     * @return integer 
     */
    public function getResortId()
    {
        return $this->resortId;
    }

    /**
     * Set roomId
     *
     * @param integer $roomId
     * @return InventoryHotels
     */
    public function setRoomId($roomId)
    {
        $this->roomId = $roomId;

        return $this;
    }

    /**
     * Get roomId
     *
     * @return integer 
     */
    public function getRoomId()
    {
        return $this->roomId;
    }

    /**
     * Set hotelName
     *
     * @param string $hotelName
     * @return InventoryHotels
     */
    public function setHotelName($hotelName)
    {
        $this->hotelName = $hotelName;

        return $this;
    }

    /**
     * Get hotelName
     *
     * @return string 
     */
    public function getHotelName()
    {
        return $this->hotelName;
    }

    /**
     * Set roomCategory
     *
     * @param string $roomCategory
     * @return InventoryHotels
     */
    public function setRoomCategory($roomCategory)
    {
        $this->roomCategory = $roomCategory;

        return $this;
    }

    /**
     * Get roomCategory
     *
     * @return string 
     */
    public function getRoomCategory()
    {
        return $this->roomCategory;
    }

    /**
     * Set numberAvailable
     *
     * @param integer $numberAvailable
     * @return InventoryHotels
     */
    public function setNumberAvailable($numberAvailable)
    {
        $this->numberAvailable = $numberAvailable;

        return $this;
    }

    /**
     * Get numberAvailable
     *
     * @return integer 
     */
    public function getNumberAvailable()
    {
        return $this->numberAvailable;
    }

    /**
     * Set dateFrom
     *
     * @param \DateTime $dateFrom
     * @return InventoryHotels
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
     * @return InventoryHotels
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
     * @return InventoryHotels
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
     * @return InventoryHotels
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
     * @return InventoryHotels
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
     * @return InventoryHotels
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
