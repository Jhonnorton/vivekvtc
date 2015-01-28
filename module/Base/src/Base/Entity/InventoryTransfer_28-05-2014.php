<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InventoryTransfer
 *
 * @ORM\Table(name="inventory_transfer")
 * @ORM\Entity
 */
class InventoryTransfer extends Base\BaseEntity
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
     * @var string
     *
     * @ORM\Column(name="hotel_name", type="string", length=50, nullable=true)
     */
    protected $hotelName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="supplier_name", type="string", length=128, nullable=false)
     */
    protected $supplierName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_to", type="date", nullable=true)
     */
    protected $dateTo;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_from", type="date", nullable=true)
     */
    protected $dateFrom;

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
     * @return InventoryTransfer
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
     * Set hotelName
     *
     * @param string $hotelName
     * @return InventoryTransfer
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
     * Set supplierName
     *
     * @param string $supplierName
     * @return InventoryTransfer
     */
    public function setSupplierName($supplierName)
    {
        $this->supplierName = $supplierName;

        return $this;
    }

    /**
     * Get supplierName
     *
     * @return string 
     */
    public function getSupplierName()
    {
        return $this->supplierName;
    }
    /**
     * Set dateTo
     *
     * @param \DateTime $dateTo
     * @return InventoryTransfer
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
     * Set dateFrom
     *
     * @param \DateTime $dateFrom
     * @return InventoryTransfer
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
     * Set netPrice
     *
     * @param string $netPrice
     * @return InventoryTransfer
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
     * @return InventoryTransfer
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
}
