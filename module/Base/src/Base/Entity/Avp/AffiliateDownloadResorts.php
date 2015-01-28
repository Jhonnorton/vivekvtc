<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * AffiliateDownloadResorts
 *
 * @ORM\Table(name="affiliate_download_resorts")
 * @ORM\Entity
 */
class AffiliateDownloadResorts
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
     * @ORM\Column(name="resort_id", type="integer", nullable=false)
     */
    private $resortId;

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
     * Set resortId
     *
     * @param integer $resortId
     * @return AffiliateDownloadResorts
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
     * Set affiliateDownloadId
     *
     * @param integer $affiliateDownloadId
     * @return AffiliateDownloadResorts
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
