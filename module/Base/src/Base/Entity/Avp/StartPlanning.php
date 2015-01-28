<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * StartPlanning
 *
 * @ORM\Table(name="start_planning")
 * @ORM\Entity
 */
class StartPlanning
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
     * @ORM\Column(name="name", type="string", length=64, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=64, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=34, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text", nullable=false)
     */
    private $address;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="occasion", type="string", length=64, nullable=false)
     */
    private $occasion;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_of_travel", type="integer", nullable=false)
     */
    private $numberOfTravel;

    /**
     * @var string
     *
     * @ORM\Column(name="budget_range", type="string", length=64, nullable=false)
     */
    private $budgetRange;

    /**
     * @var string
     *
     * @ORM\Column(name="star_rating", type="string", length=32, nullable=false)
     */
    private $starRating;

    /**
     * @var string
     *
     * @ORM\Column(name="airfare_quotes", type="string", nullable=false)
     */
    private $airfareQuotes;

    /**
     * @var string
     *
     * @ORM\Column(name="trip_insurance_quote", type="string", nullable=false)
     */
    private $tripInsuranceQuote;

    /**
     * @var string
     *
     * @ORM\Column(name="car_rental", type="string", nullable=false)
     */
    private $carRental;

    /**
     * @var string
     *
     * @ORM\Column(name="need_entertainment", type="string", nullable=false)
     */
    private $needEntertainment;

    /**
     * @var string
     *
     * @ORM\Column(name="additional_notes_and _request", type="text", nullable=true)
     */
    private $additionalNotesAndRequest;



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
     * Set name
     *
     * @param string $name
     * @return StartPlanning
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return StartPlanning
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
     * @return StartPlanning
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
     * Set address
     *
     * @param string $address
     * @return StartPlanning
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return StartPlanning
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

    /**
     * Set occasion
     *
     * @param string $occasion
     * @return StartPlanning
     */
    public function setOccasion($occasion)
    {
        $this->occasion = $occasion;

        return $this;
    }

    /**
     * Get occasion
     *
     * @return string 
     */
    public function getOccasion()
    {
        return $this->occasion;
    }

    /**
     * Set numberOfTravel
     *
     * @param integer $numberOfTravel
     * @return StartPlanning
     */
    public function setNumberOfTravel($numberOfTravel)
    {
        $this->numberOfTravel = $numberOfTravel;

        return $this;
    }

    /**
     * Get numberOfTravel
     *
     * @return integer 
     */
    public function getNumberOfTravel()
    {
        return $this->numberOfTravel;
    }

    /**
     * Set budgetRange
     *
     * @param string $budgetRange
     * @return StartPlanning
     */
    public function setBudgetRange($budgetRange)
    {
        $this->budgetRange = $budgetRange;

        return $this;
    }

    /**
     * Get budgetRange
     *
     * @return string 
     */
    public function getBudgetRange()
    {
        return $this->budgetRange;
    }

    /**
     * Set starRating
     *
     * @param string $starRating
     * @return StartPlanning
     */
    public function setStarRating($starRating)
    {
        $this->starRating = $starRating;

        return $this;
    }

    /**
     * Get starRating
     *
     * @return string 
     */
    public function getStarRating()
    {
        return $this->starRating;
    }

    /**
     * Set airfareQuotes
     *
     * @param string $airfareQuotes
     * @return StartPlanning
     */
    public function setAirfareQuotes($airfareQuotes)
    {
        $this->airfareQuotes = $airfareQuotes;

        return $this;
    }

    /**
     * Get airfareQuotes
     *
     * @return string 
     */
    public function getAirfareQuotes()
    {
        return $this->airfareQuotes;
    }

    /**
     * Set tripInsuranceQuote
     *
     * @param string $tripInsuranceQuote
     * @return StartPlanning
     */
    public function setTripInsuranceQuote($tripInsuranceQuote)
    {
        $this->tripInsuranceQuote = $tripInsuranceQuote;

        return $this;
    }

    /**
     * Get tripInsuranceQuote
     *
     * @return string 
     */
    public function getTripInsuranceQuote()
    {
        return $this->tripInsuranceQuote;
    }

    /**
     * Set carRental
     *
     * @param string $carRental
     * @return StartPlanning
     */
    public function setCarRental($carRental)
    {
        $this->carRental = $carRental;

        return $this;
    }

    /**
     * Get carRental
     *
     * @return string 
     */
    public function getCarRental()
    {
        return $this->carRental;
    }

    /**
     * Set needEntertainment
     *
     * @param string $needEntertainment
     * @return StartPlanning
     */
    public function setNeedEntertainment($needEntertainment)
    {
        $this->needEntertainment = $needEntertainment;

        return $this;
    }

    /**
     * Get needEntertainment
     *
     * @return string 
     */
    public function getNeedEntertainment()
    {
        return $this->needEntertainment;
    }

    /**
     * Set additionalNotesAndRequest
     *
     * @param string $additionalNotesAndRequest
     * @return StartPlanning
     */
    public function setAdditionalNotesAndRequest($additionalNotesAndRequest)
    {
        $this->additionalNotesAndRequest = $additionalNotesAndRequest;

        return $this;
    }

    /**
     * Get additionalNotesAndRequest
     *
     * @return string 
     */
    public function getAdditionalNotesAndRequest()
    {
        return $this->additionalNotesAndRequest;
    }
}
