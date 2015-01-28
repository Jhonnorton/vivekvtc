<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity
 */
class Orders extends Base\BaseEntity
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
     * @ORM\Column(name="type", type="integer", nullable=false)
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_person", type="string", length=32, nullable=false)
     */
    protected $contactPerson;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=32, nullable=false)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=24, nullable=false)
     */
    protected $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="flight_going_away", type="string", length=64, nullable=true)
     */
    protected $flightGoingAway;

    /**
     * @var string
     *
     * @ORM\Column(name="flight_return_home", type="string", length=64, nullable=true)
     */
    protected $flightReturnHome;

    /**
     * @var integer
     *
     * @ORM\Column(name="no_of_person", type="integer", nullable=false)
     */
    protected $noOfPerson;

    /**
     * @var string
     *
     * @ORM\Column(name="group_name", type="string", length=255, nullable=false)
     */
    protected $groupName;

    /**
     * @var string
     *
     * @ORM\Column(name="room_category", type="string", length=255, nullable=true)
     */
    protected $roomCategory;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="travel_from", type="date", nullable=false)
     */
    protected $travelFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="travel_to", type="date", nullable=false)
     */
    protected $travelTo;

    /**
     * @var integer
     *
     * @ORM\Column(name="room_rate", type="integer", nullable=true)
     */
    protected $roomRate;

    /**
     * @var integer
     *
     * @ORM\Column(name="rooms_required", type="integer", nullable=false)
     */
    protected $roomsRequired;

    /**
     * @var string
     *
     * @ORM\Column(name="deposit_due_amount", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $depositDueAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="deposit_due_amount2", type="decimal", precision=10, scale=2, nullable=true)
     */
    protected $depositDueAmount2;

    /**
     * @var string
     *
     * @ORM\Column(name="deposit_due_amount3", type="decimal", precision=10, scale=2, nullable=true)
     */
    protected $depositDueAmount3;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deposit_due_date", type="date", nullable=true)
     */
    protected $depositDueDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deposit_due_date2", type="date", nullable=true)
     */
    protected $depositDueDate2;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deposit_due_date3", type="date", nullable=true)
     */
    protected $depositDueDate3;

    /**
     * @var string
     *
     * @ORM\Column(name="transfer_amount", type="decimal", precision=10, scale=2, nullable=true)
     */
    protected $transferAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="trip_insurance_cost", type="decimal", precision=10, scale=2, nullable=true)
     */
    protected $tripInsuranceCost;

    /**
     * @var string
     *
     * @ORM\Column(name="flight_amount", type="decimal", precision=10, scale=2, nullable=true)
     */
    protected $flightAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="room_total_amount", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $roomTotalAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="discount_amount", type="decimal", precision=10, scale=2, nullable=true)
     */
    protected $discountAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="merchant_fee", type="decimal", precision=10, scale=2, nullable=true)
     */
    protected $merchantFee;

    /**
     * @var string
     *
     * @ORM\Column(name="total_amount", type="decimal", precision=10, scale=2, nullable=false)
     */
    protected $totalAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="mailing_address", type="text", nullable=false)
     */
    protected $mailingAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="billing_address", type="text", nullable=false)
     */
    protected $billingAddress;

    /**
     * @var string
     *
     * @ORM\Column(name="name_on_cc", type="string", length=50, nullable=true)
     */
    protected $nameOnCc;

    /**
     * @var boolean
     *
     * @ORM\Column(name="type_of_card", type="boolean", nullable=true)
     */
    protected $typeOfCard;

    /**
     * @var string
     *
     * @ORM\Column(name="card_number", type="string", length=50, nullable=true)
     */
    protected $cardNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="csv_number", type="string", length=50, nullable=true)
     */
    protected $csvNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="card_expity_date", type="date", nullable=true)
     */
    protected $cardExpityDate;

    /**
     * @var string
     *
     * @ORM\Column(name="comments", type="text", nullable=true)
     */
    protected $comments;



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
     * Set type
     *
     * @param integer $type
     * @return Orders
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set contactPerson
     *
     * @param string $contactPerson
     * @return Orders
     */
    public function setContactPerson($contactPerson)
    {
        $this->contactPerson = $contactPerson;

        return $this;
    }

    /**
     * Get contactPerson
     *
     * @return string 
     */
    public function getContactPerson()
    {
        return $this->contactPerson;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Orders
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Orders
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set flightGoingAway
     *
     * @param string $flightGoingAway
     * @return Orders
     */
    public function setFlightGoingAway($flightGoingAway)
    {
        $this->flightGoingAway = $flightGoingAway;

        return $this;
    }

    /**
     * Get flightGoingAway
     *
     * @return string 
     */
    public function getFlightGoingAway()
    {
        return $this->flightGoingAway;
    }

    /**
     * Set flightReturnHome
     *
     * @param string $flightReturnHome
     * @return Orders
     */
    public function setFlightReturnHome($flightReturnHome)
    {
        $this->flightReturnHome = $flightReturnHome;

        return $this;
    }

    /**
     * Get flightReturnHome
     *
     * @return string 
     */
    public function getFlightReturnHome()
    {
        return $this->flightReturnHome;
    }

    /**
     * Set noOfPerson
     *
     * @param integer $noOfPerson
     * @return Orders
     */
    public function setNoOfPerson($noOfPerson)
    {
        $this->noOfPerson = $noOfPerson;

        return $this;
    }

    /**
     * Get noOfPerson
     *
     * @return integer 
     */
    public function getNoOfPerson()
    {
        return $this->noOfPerson;
    }

    /**
     * Set groupName
     *
     * @param string $groupName
     * @return Orders
     */
    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;

        return $this;
    }

    /**
     * Get groupName
     *
     * @return string 
     */
    public function getGroupName()
    {
        return $this->groupName;
    }

    /**
     * Set roomCategory
     *
     * @param string $roomCategory
     * @return Orders
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
     * Set travelFrom
     *
     * @param \DateTime $travelFrom
     * @return Orders
     */
    public function setTravelFrom($travelFrom)
    {
        $this->travelFrom = $travelFrom;

        return $this;
    }

    /**
     * Get travelFrom
     *
     * @return \DateTime 
     */
    public function getTravelFrom()
    {
        return $this->travelFrom;
    }

    /**
     * Set travelTo
     *
     * @param \DateTime $travelTo
     * @return Orders
     */
    public function setTravelTo($travelTo)
    {
        $this->travelTo = $travelTo;

        return $this;
    }

    /**
     * Get travelTo
     *
     * @return \DateTime 
     */
    public function getTravelTo()
    {
        return $this->travelTo;
    }

    /**
     * Set roomRate
     *
     * @param integer $roomRate
     * @return Orders
     */
    public function setRoomRate($roomRate)
    {
        $this->roomRate = $roomRate;

        return $this;
    }

    /**
     * Get roomRate
     *
     * @return integer 
     */
    public function getRoomRate()
    {
        return $this->roomRate;
    }

    /**
     * Set roomsRequired
     *
     * @param integer $roomsRequired
     * @return Orders
     */
    public function setRoomsRequired($roomsRequired)
    {
        $this->roomsRequired = $roomsRequired;

        return $this;
    }

    /**
     * Get roomsRequired
     *
     * @return integer 
     */
    public function getRoomsRequired()
    {
        return $this->roomsRequired;
    }

    /**
     * Set depositDueAmount
     *
     * @param string $depositDueAmount
     * @return Orders
     */
    public function setDepositDueAmount($depositDueAmount)
    {
        $this->depositDueAmount = $depositDueAmount;

        return $this;
    }

    /**
     * Get depositDueAmount
     *
     * @return string 
     */
    public function getDepositDueAmount()
    {
        return $this->depositDueAmount;
    }

    /**
     * Set depositDueAmount2
     *
     * @param string $depositDueAmount2
     * @return Orders
     */
    public function setDepositDueAmount2($depositDueAmount2)
    {
        $this->depositDueAmount2 = $depositDueAmount2;

        return $this;
    }

    /**
     * Get depositDueAmount2
     *
     * @return string 
     */
    public function getDepositDueAmount2()
    {
        return $this->depositDueAmount2;
    }

    /**
     * Set depositDueAmount3
     *
     * @param string $depositDueAmount3
     * @return Orders
     */
    public function setDepositDueAmount3($depositDueAmount3)
    {
        $this->depositDueAmount3 = $depositDueAmount3;

        return $this;
    }

    /**
     * Get depositDueAmount3
     *
     * @return string 
     */
    public function getDepositDueAmount3()
    {
        return $this->depositDueAmount3;
    }

    /**
     * Set depositDueDate
     *
     * @param \DateTime $depositDueDate
     * @return Orders
     */
    public function setDepositDueDate($depositDueDate)
    {
        $this->depositDueDate = $depositDueDate;

        return $this;
    }

    /**
     * Get depositDueDate
     *
     * @return \DateTime 
     */
    public function getDepositDueDate()
    {
        return $this->depositDueDate;
    }

    /**
     * Set depositDueDate2
     *
     * @param \DateTime $depositDueDate2
     * @return Orders
     */
    public function setDepositDueDate2($depositDueDate2)
    {
        $this->depositDueDate2 = $depositDueDate2;

        return $this;
    }

    /**
     * Get depositDueDate2
     *
     * @return \DateTime 
     */
    public function getDepositDueDate2()
    {
        return $this->depositDueDate2;
    }

    /**
     * Set depositDueDate3
     *
     * @param \DateTime $depositDueDate3
     * @return Orders
     */
    public function setDepositDueDate3($depositDueDate3)
    {
        $this->depositDueDate3 = $depositDueDate3;

        return $this;
    }

    /**
     * Get depositDueDate3
     *
     * @return \DateTime 
     */
    public function getDepositDueDate3()
    {
        return $this->depositDueDate3;
    }

    /**
     * Set transferAmount
     *
     * @param string $transferAmount
     * @return Orders
     */
    public function setTransferAmount($transferAmount)
    {
        $this->transferAmount = $transferAmount;

        return $this;
    }

    /**
     * Get transferAmount
     *
     * @return string 
     */
    public function getTransferAmount()
    {
        return $this->transferAmount;
    }

    /**
     * Set tripInsuranceCost
     *
     * @param string $tripInsuranceCost
     * @return Orders
     */
    public function setTripInsuranceCost($tripInsuranceCost)
    {
        $this->tripInsuranceCost = $tripInsuranceCost;

        return $this;
    }

    /**
     * Get tripInsuranceCost
     *
     * @return string 
     */
    public function getTripInsuranceCost()
    {
        return $this->tripInsuranceCost;
    }

    /**
     * Set flightAmount
     *
     * @param string $flightAmount
     * @return Orders
     */
    public function setFlightAmount($flightAmount)
    {
        $this->flightAmount = $flightAmount;

        return $this;
    }

    /**
     * Get flightAmount
     *
     * @return string 
     */
    public function getFlightAmount()
    {
        return $this->flightAmount;
    }

    /**
     * Set roomTotalAmount
     *
     * @param string $roomTotalAmount
     * @return Orders
     */
    public function setRoomTotalAmount($roomTotalAmount)
    {
        $this->roomTotalAmount = $roomTotalAmount;

        return $this;
    }

    /**
     * Get roomTotalAmount
     *
     * @return string 
     */
    public function getRoomTotalAmount()
    {
        return $this->roomTotalAmount;
    }

    /**
     * Set discountAmount
     *
     * @param string $discountAmount
     * @return Orders
     */
    public function setDiscountAmount($discountAmount)
    {
        $this->discountAmount = $discountAmount;

        return $this;
    }

    /**
     * Get discountAmount
     *
     * @return string 
     */
    public function getDiscountAmount()
    {
        return $this->discountAmount;
    }

    /**
     * Set merchantFee
     *
     * @param string $merchantFee
     * @return Orders
     */
    public function setMerchantFee($merchantFee)
    {
        $this->merchantFee = $merchantFee;

        return $this;
    }

    /**
     * Get merchantFee
     *
     * @return string 
     */
    public function getMerchantFee()
    {
        return $this->merchantFee;
    }

    /**
     * Set totalAmount
     *
     * @param string $totalAmount
     * @return Orders
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * Get totalAmount
     *
     * @return string 
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    /**
     * Set mailingAddress
     *
     * @param string $mailingAddress
     * @return Orders
     */
    public function setMailingAddress($mailingAddress)
    {
        $this->mailingAddress = $mailingAddress;

        return $this;
    }

    /**
     * Get mailingAddress
     *
     * @return string 
     */
    public function getMailingAddress()
    {
        return $this->mailingAddress;
    }

    /**
     * Set billingAddress
     *
     * @param string $billingAddress
     * @return Orders
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    /**
     * Get billingAddress
     *
     * @return string 
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * Set nameOnCc
     *
     * @param string $nameOnCc
     * @return Orders
     */
    public function setNameOnCc($nameOnCc)
    {
        $this->nameOnCc = $nameOnCc;

        return $this;
    }

    /**
     * Get nameOnCc
     *
     * @return string 
     */
    public function getNameOnCc()
    {
        return $this->nameOnCc;
    }

    /**
     * Set typeOfCard
     *
     * @param boolean $typeOfCard
     * @return Orders
     */
    public function setTypeOfCard($typeOfCard)
    {
        $this->typeOfCard = $typeOfCard;

        return $this;
    }

    /**
     * Get typeOfCard
     *
     * @return boolean 
     */
    public function getTypeOfCard()
    {
        return $this->typeOfCard;
    }

    /**
     * Set cardNumber
     *
     * @param string $cardNumber
     * @return Orders
     */
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * Get cardNumber
     *
     * @return string 
     */
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * Set csvNumber
     *
     * @param string $csvNumber
     * @return Orders
     */
    public function setCsvNumber($csvNumber)
    {
        $this->csvNumber = $csvNumber;

        return $this;
    }

    /**
     * Get csvNumber
     *
     * @return string 
     */
    public function getCsvNumber()
    {
        return $this->csvNumber;
    }

    /**
     * Set cardExpityDate
     *
     * @param \DateTime $cardExpityDate
     * @return Orders
     */
    public function setCardExpityDate($cardExpityDate)
    {
        $this->cardExpityDate = $cardExpityDate;

        return $this;
    }

    /**
     * Get cardExpityDate
     *
     * @return \DateTime 
     */
    public function getCardExpityDate()
    {
        return $this->cardExpityDate;
    }

    /**
     * Set comments
     *
     * @param string $comments
     * @return Orders
     */
    public function setComments($comments)
    {
        $this->comments = $comments;

        return $this;
    }

    /**
     * Get comments
     *
     * @return string 
     */
    public function getComments()
    {
        return $this->comments;
    }
}
