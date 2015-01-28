<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InventoryTourRooms
 *
 * @ORM\Table(name="inventory_tour_rooms")
 * @ORM\Entity
 */
class InventoryTourRooms extends Base\BaseEntity
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
     * @var \Base\Entity\Tours
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\Tours")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="tour_id", referencedColumnName="id")
     * })
     */
    private $tourId;

   
    
        /**
     * @var \Base\Entity\TourLocations
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\TourLocations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="location_id", referencedColumnName="id")
     * })
     */
    private $locationId;
    
       /**
     * @var \Base\Entity\Avp\Resorts
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\Avp\Resorts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resort_id", referencedColumnName="id")
     * })
     */
    protected $resortId;
    
      /**
     * @var \Base\Entity\Avp\ResortRooms
     *
     * @ORM\ManyToOne(targetEntity="\Base\Entity\Avp\ResortRooms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     * })
     */
    protected $roomId;
  
    
     /**
     * @var boolean
     *
     * @ORM\Column(name="board", type="integer", nullable=false)
     */
    protected $board;
    
    
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
     * @var integer
     *
     * @ORM\Column(name="per_person_per_room", type="integer", nullable=false)
     */
    protected $pricePer;
    
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="double_occupancy", type="boolean", nullable=false)
     */
    protected $doubleOccupancyRate;
    
    
     /**
     * @var integer
     *
     * @ORM\Column(name="number_of_males", type="integer", nullable=false)
     */
    protected $malesCount;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="number_of_females", type="integer", nullable=false)
     */
    protected $femalesCount;
    
     /**
     * @var boolean
     *
     * @ORM\Column(name="triple_occupancy", type="boolean", nullable=false)
     */
    protected $tripleOccupancyAllowed;
    
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="triple_female_na", type="boolean", nullable=false)
     */
    protected $tripleFemaleNa;
    
    
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="triple_male_na", type="boolean", nullable=false)
     */
    protected $tripleMaleNa;
    
    
    
     /**
     * @var integer
     *
     * @ORM\Column(name="net_cost_per_female_triple", type="integer", nullable=false)
     */
    protected $triplePriceFemaleNet = 0;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="gross_cost_per_female_triple", type="integer", nullable=false)
     */
    protected $triplePriceFemaleGross = 0;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="net_cost_per_male_triple", type="integer", nullable=false)
     */
    protected $triplePriceMaleNet = 0;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="gross_cost_per_male_triple", type="integer", nullable=false)
     */
    protected $triplePriceMaleGross = 0;
    
    
      /**
     * @var boolean
     *
     * @ORM\Column(name="quad_occupancy", type="boolean", nullable=false)
     */
    protected $quadOccupancy;
    
    
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="premium_single_occupancy", type="boolean", nullable=false)
     */
    protected $singlePremiumOccupancy;
    
    
    
      /**
     * @var integer
     *
     * @ORM\Column(name="premium_single_gross_cost", type="integer", nullable=false)
     */
    protected $singlePriceGross = 0;
    
     /**
     * @var integer
     *
     * @ORM\Column(name="premium_single_net_cost", type="integer", nullable=false)
     */
    protected $singlePriceNet = 0;
    
    
    
      /**
     * @var boolean
     *
     * @ORM\Column(name="single_share", type="boolean", nullable=false)
     */
    protected $singleShare = 0;
    
    
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    protected $status = '1';
    
    
      /**
     * @var boolean
     *
     * @ORM\Column(name="is_deleted", type="boolean", nullable=true)
     */
    protected $isDeleted = '0';
    
    
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    protected $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="datetime", nullable=true)
     */
    protected $modified;
    
    
     /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Set tourId
     *
     * @param integer $tourId
     * @return InventoryTourRooms
     */
    public function setTourId($tourId) {
        $this->tourId = $tourId;

        return $this;
    }

    /**
     * Get tourId
     *
     * @return integer 
     */
    public function getTourId() {
        return $this->tourId;
    }
    
    
    
    
    
    
    /**
     * Set locationId
     *
     * @param integer $locationId
     * @return InventoryTourRooms
     */
    public function setLocationId($locationId) {
        $this->locationId = $locationId;

        return $this;
    }

    /**
     * Get locationId
     *
     * @return integer 
     */
    public function getLocationId() {
        return $this->locationId;
    }
    
    
     /**
     * Set resortId
     *
     * @param integer $resortId
     * @return InventoryTourRooms
     */
    public function setResortId($resortId) {
        $this->resortId = $resortId;

        return $this;
    }

    /**
     * Get resortId
     *
     * @return integer 
     */
    public function getResortId() {
        return $this->resortId;
    }
  
    
   
      /**
     * Set roomId
     *
     * @param integer $roomId
     * @return InventoryTourRooms
     */
    public function setRoomId($roomId) {
        $this->roomId = $roomId;

        return $this;
    }

    /**
     * Get roomId
     *
     * @return integer 
     */
    public function getRoomId() {
        return $this->roomId;
    }
    
    
   
     /**
     * Set isDeleted
     *
     * @param boolean $isDeleted
     * @return InventoryTourRooms
     */
    public function setIsDeleted($isDeleted) {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getIsDeleted() {
        return $this->isDeleted;
    }
    
    /**
     * Set status
     *
     * @param boolean $status
     * @return InventoryTourRooms
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus() {
        return $this->status;
    }
    
        
    
      /**
     * Set created
     *
     * @param \DateTime $created
     * @return InventoryTourRooms
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return InventoryTourRooms
     */
    public function setModified($modified) {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified() {
        return $this->modified;
    }

     /**
     * Set netPrice
     *
     * @param string $netPrice
     * @return InventoryTourRooms
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
     * @return InventoryTourRooms
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
     * Set $board
     *
     * @param integer $$board
     * @return InventoryTourRooms
     */
    public function setBoard($board)
    {
        $this->board = $board;

        return $this;
    }

    /**
     * Get board
     *
     * @return integer 
     */
    public function getBoard()
    {
        return $this->board;
    }
    
     /**
     * Set doubleOccupancyRate
     *
     * @param integer $doubleOccupancyRate
     * @return InventoryTourRooms
     */
    public function setDoubleOccupancyRate($doubleOccupancyRate)
    {
        $this->doubleOccupancyRate = $doubleOccupancyRate;

        return $this;
    }

    /**
     * Get doubleOccupancyRate
     *
     * @return integer 
     */
    public function getDoubleOccupancyRate()
    {
        return $this->doubleOccupancyRate;
    }
    
    
     /**
     * Set pricePer
     *
     * @param integer $pricePer
     * @return InventoryTourRooms
     */
    public function setPricePer($pricePer)
    {
        $this->pricePer = $pricePer;

        return $this;
    }

    /**
     * Get pricePer
     *
     * @return integer 
     */
    public function getPricePer()
    {
        return $this->pricePer;
    }
    
    
    /**
     * Set femalesCount
     *
     * @param integer $femalesCount
     * @return InventoryTourRooms
     */
    public function setFemalesCount($femalesCount)
    {
        $this->femalesCount = $femalesCount;

        return $this;
    }

    /**
     * Get femalesCount
     *
     * @return integer 
     */
    public function getFemalesCount()
    {
        return $this->femalesCount;
    }
    
    /**
     * Set malesCount
     *
     * @param integer $malesCount
     * @return InventoryTourRooms
     */
    public function setMalesCount($malesCount)
    {
        $this->malesCount = $malesCount;

        return $this;
    }

    /**
     * Get malesCount
     *
     * @return integer 
     */
    public function getMalesCount()
    {
        return $this->malesCount;
    }
    
    /**
     * Set tripleOccupancyAllowed
     *
     * @param integer $tripleOccupancyAllowed
     * @return InventoryTourRooms
     */
    public function setTripleOccupancyAllowed($tripleOccupancyAllowed)
    {
        $this->tripleOccupancyAllowed = $tripleOccupancyAllowed;

        return $this;
    }

    /**
     * Get tripleOccupancyAllowed
     *
     * @return integer 
     */
    public function getTripleOccupancyAllowed()
    {
        return $this->tripleOccupancyAllowed;
    }

    
     /**
     * Set triplePriceFemaleNet
     *
     * @param integer $triplePriceFemaleNet
     * @return InventoryTourRooms
     */
    public function setTriplePriceFemaleNet($triplePriceFemaleNet)
    {
        $this->triplePriceFemaleNet = $triplePriceFemaleNet;

        return $this;
    }

    /**
     * Get triplePriceFemaleNet
     *
     * @return integer 
     */
    public function getTriplePriceFemaleNet()
    {
        return $this->triplePriceFemaleNet;
    }
    
    /**
     * Set triplePriceFemaleGross
     *
     * @param integer $triplePriceFemaleGross
     * @return InventoryTourRooms
     */
    public function setTriplePriceFemaleGross($triplePriceFemaleGross)
    {
        $this->triplePriceFemaleGross = $triplePriceFemaleGross;

        return $this;
    }

    /**
     * Get triplePriceFemaleNet
     *
     * @return integer 
     */
    public function getTriplePriceFemaleGross()
    {
        return $this->triplePriceFemaleGross;
    }
    
    /**
     * Set triplePriceMaleNet
     *
     * @param integer $triplePriceMaleNet
     * @return InventoryTourRooms
     */
    public function setTriplePriceMaleNet($triplePriceMaleNet)
    {
        $this->triplePriceMaleNet = $triplePriceMaleNet;

        return $this;
    }

    /**
     * Get triplePriceMaleNet
     *
     * @return integer 
     */
    public function getTriplePriceMaleNet()
    {
        return $this->triplePriceMaleNet;
    }
    
    /**
     * Set triplePriceMaleGross
     *
     * @param integer $triplePriceMaleGross
     * @return InventoryTourRooms
     */
    public function setTriplePriceMaleGross($triplePriceMaleGross)
    {
        $this->triplePriceMaleGross = $triplePriceMaleGross;

        return $this;
    }

    /**
     * Get triplePriceMaleGross
     *
     * @return integer 
     */
    public function getTriplePriceMaleGross()
    {
        return $this->triplePriceMaleGross;
    }
    
    
      /**
     * Set tripleFemaleNa
     *
     * @param integer $tripleFemaleNa
     * @return InventoryTourRooms
     */
    public function setTripleFemaleNa($tripleFemaleNa)
    {
        $this->tripleFemaleNa = $tripleFemaleNa;

        return $this;
    }

    /**
     * Get tripleFemaleNa
     *
     * @return integer 
     */
    public function getTripleFemaleNa()
    {
        return $this->tripleOccupancyAllowed;
    }
    
    
            
             /**
     * Set tripleMaleNa
     *
     * @param integer $tripleMaleNa
     * @return InventoryTourRooms
     */
    public function setTripleMaleNa($tripleMaleNa)
    {
        $this->tripleMaleNa = $tripleMaleNa;

        return $this;
    }

    /**
     * Get tripleFemaleNa
     *
     * @return integer 
     */
    public function getTripleMaleNa()
    {
        return $this->tripleMaleNa;
    }
    
     /**
     * Set quadOccupancy
     *
     * @param integer $quadOccupancy
     * @return InventoryTourRooms
     */
    public function setQuadOccupancy($quadOccupancy)
    {
        $this->quadOccupancy = $quadOccupancy;

        return $this;
    }

    /**
     * Get quadOccupancy
     *
     * @return integer 
     */
    public function getQuadOccupancy()
    {
        return $this->quadOccupancy;
    }
    
    
    /**
     * Set quadOccupancy
     *
     * @param integer $quadOccupancy
     * @return InventoryTourRooms
     */
    public function setSinglePremiumOccupancy($singlePremiumOccupancy)
    {
        $this->singlePremiumOccupancy = $singlePremiumOccupancy;

        return $this;
    }

    /**
     * Get quadOccupancy
     *
     * @return integer 
     */
    public function getSinglePremiumOccupancy()
    {
        return $this->singlePremiumOccupancy;
    }
    
    
    
    /**
     * Set singlePriceNet
     *
     * @param integer $singlePriceNet 
     * @return InventoryTourRooms
     */
    public function setSinglePriceNet($singlePriceNet)
    {
        $this->singlePriceNet = $singlePriceNet;

        return $this;
    }

    /**
     * Get $singlePriceNet
     *
     * @return integer 
     */
    public function getSinglePriceNet()
    {
        return $this->singlePriceNet;
    }
    
      
    /**
     * Set singlePriceGross
     *
     * @param integer $singlePriceGross
     * @return InventoryTourRooms
     */
    public function setSinglePriceGross($singlePriceGross)
    {
        $this->singlePriceGross = $singlePriceGross;

        return $this;
    }

    /**
     * Get $singlePriceGross
     *
     * @return integer 
     */
    public function getSinglePriceGross()
    {
        return $this->singlePriceGross;
    }
    
    
     /**
     * Set singleShare
     *
     * @param integer $singleShare
     * @return InventoryTourRooms
     */
    public function setSingleShare($singleShare)
    {
        $this->singleShare = $singleShare;

        return $this;
    }

    /**
     * Get singleShare
     *
     * @return integer 
     */
    public function getSingleShare()
    {
        return $this->singleShare;
    }
    
}
