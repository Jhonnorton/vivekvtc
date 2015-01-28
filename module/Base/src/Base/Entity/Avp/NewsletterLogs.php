<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * NewsletterLogs
 *
 * @ORM\Table(name="newsletter_logs")
 * @ORM\Entity
 */
class NewsletterLogs
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
     * @ORM\Column(name="campaign_id", type="integer", nullable=false)
     */
    private $campaignId;

    /**
     * @var integer
     *
     * @ORM\Column(name="newsletter_subscriber_id", type="integer", nullable=false)
     */
    private $newsletterSubscriberId;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_sent", type="integer", nullable=true)
     */
    private $isSent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="log_time", type="datetime", nullable=true)
     */
    private $logTime;



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
     * Set campaignId
     *
     * @param integer $campaignId
     * @return NewsletterLogs
     */
    public function setCampaignId($campaignId)
    {
        $this->campaignId = $campaignId;

        return $this;
    }

    /**
     * Get campaignId
     *
     * @return integer 
     */
    public function getCampaignId()
    {
        return $this->campaignId;
    }

    /**
     * Set newsletterSubscriberId
     *
     * @param integer $newsletterSubscriberId
     * @return NewsletterLogs
     */
    public function setNewsletterSubscriberId($newsletterSubscriberId)
    {
        $this->newsletterSubscriberId = $newsletterSubscriberId;

        return $this;
    }

    /**
     * Get newsletterSubscriberId
     *
     * @return integer 
     */
    public function getNewsletterSubscriberId()
    {
        return $this->newsletterSubscriberId;
    }

    /**
     * Set isSent
     *
     * @param integer $isSent
     * @return NewsletterLogs
     */
    public function setIsSent($isSent)
    {
        $this->isSent = $isSent;

        return $this;
    }

    /**
     * Get isSent
     *
     * @return integer 
     */
    public function getIsSent()
    {
        return $this->isSent;
    }

    /**
     * Set logTime
     *
     * @param \DateTime $logTime
     * @return NewsletterLogs
     */
    public function setLogTime($logTime)
    {
        $this->logTime = $logTime;

        return $this;
    }

    /**
     * Get logTime
     *
     * @return \DateTime 
     */
    public function getLogTime()
    {
        return $this->logTime;
    }
}
