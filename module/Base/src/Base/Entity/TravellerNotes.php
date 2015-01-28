<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TravellerNotes
 *
 * @ORM\Table(name="traveller_notes")
 * @ORM\Entity
 */
class TravellerNotes extends Base\BaseEntity
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
     * @ORM\Column(name="traveller_id", type="integer", nullable=false)
     */
    protected $travellerId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="reminder_date", type="date", nullable=true)
     */
    protected $reminderDate;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255, nullable=true)
     */
    protected $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=600, nullable=true)
     */
    protected $message;

   



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
     * Set traveller id
     *
     * @param integer $travellerId
     * @return TravellerNotes
     */
    public function setTravellerId($travellerId)
    {
        $this->travellerId = $travellerId;

        return $this;
    }

    /**
     * Get traveller id
     *
     * @return integer 
     */
    public function getTravellerID()
    {
        return $this->travellerId;
    }

    /**
     * Set reminder date
     *
     * @param \DateTime $reminderDate
     * @return TravellerNotes
     */
    public function setReminderDate($reminderDate)
    {
        $this->reminderDate = $reminderDate;

        return $this;
    }

    /**
     * Get reminder date
     *
     * @return \DateTime 
     */
    public function getReminderDate()
    {
        return $this->reminderDate;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return TravellerNotes
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return TravellerNotes
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getmessage()
    {
        return $this->message;
    }

   
}
