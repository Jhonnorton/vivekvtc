<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * AffiliateDownloadEvents
 *
 * @ORM\Table(name="affiliate_download_events")
 * @ORM\Entity
 */
class AffiliateDownloadEvents
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
     * @ORM\Column(name="event_id", type="integer", nullable=false)
     */
    private $eventId;

    /**
     * @var integer
     *
     * @ORM\Column(name="affiliate_download_id", type="integer", nullable=false)
     */
    private $affiliateDownloadId;



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
     * Set eventId
     *
     * @param integer $eventId
     * @return AffiliateDownloadEvents
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;

        return $this;
    }

    /**
     * Get eventId
     *
     * @return integer 
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * Set affiliateDownloadId
     *
     * @param integer $affiliateDownloadId
     * @return AffiliateDownloadEvents
     */
    public function setAffiliateDownloadId($affiliateDownloadId)
    {
        $this->affiliateDownloadId = $affiliateDownloadId;

        return $this;
    }

    /**
     * Get affiliateDownloadId
     *
     * @return integer 
     */
    public function getAffiliateDownloadId()
    {
        return $this->affiliateDownloadId;
    }
}
