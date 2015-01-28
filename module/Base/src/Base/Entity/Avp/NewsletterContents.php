<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsletterContents
 *
 * @ORM\Table(name="newsletter_contents")
 * @ORM\Entity
 */
class NewsletterContents
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
     * @ORM\Column(name="to_type", type="integer", nullable=false)
     */
    private $toType;
    
    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", nullable=false)
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added_on", type="datetime", nullable=false)
     */
    private $addedOn;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255, nullable=false)
     */
    private $subject;
    
    /**
     * @var integer 
     *
     * @ORM\Column(name="sender", type="integer", nullable=false)
     */
    private $sender;



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
     * Set content
     *
     * @param string $content
     * @return NewsletterContents
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
    
    /**
     * Set to_type
     *
     * @param integer $content
     * @return NewsletterContents
     */
    public function setToType($toType)
    {
        $this->toType = $toType;

        return $this;
    }

    /**
     * Get to_type
     *
     * @return integer
     */
    public function getToType()
    {
        return $this->toType;
    }

    /**
     * Set addedOn
     *
     * @param \DateTime $addedOn
     * @return NewsletterContents
     */
    public function setAddedOn($addedOn)
    {
        $this->addedOn = $addedOn;

        return $this;
    }

    /**
     * Get addedOn
     *
     * @return \DateTime 
     */
    public function getAddedOn()
    {
        return $this->addedOn;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return NewsletterContents
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
     * Set sender
     *
     * @param integer $sender
     * @return NewsletterContents
     */
    public function setSender($sender)
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * Get sender
     *
     * @return integer
     */
    public function getSender()
    {
        return $this->sender;
    }
}
