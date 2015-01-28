<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * AffiliateDownloads
 *
 * @ORM\Table(name="affiliate_downloads")
 * @ORM\Entity
 */
class AffiliateDownloads
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
     * @ORM\Column(name="file", type="string", length=50, nullable=true)
     */
    private $file;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=100, nullable=false)
     */
    private $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_blocked", type="integer", nullable=true)
     */
    private $isBlocked;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_updated", type="datetime", nullable=false)
     */
    private $lastUpdated;



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
     * Set file
     *
     * @param string $file
     * @return AffiliateDownloads
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return AffiliateDownloads
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set isBlocked
     *
     * @param integer $isBlocked
     * @return AffiliateDownloads
     */
    public function setIsBlocked($isBlocked)
    {
        $this->isBlocked = $isBlocked;

        return $this;
    }

    /**
     * Get isBlocked
     *
     * @return integer 
     */
    public function getIsBlocked()
    {
        return $this->isBlocked;
    }

    /**
     * Set lastUpdated
     *
     * @param \DateTime $lastUpdated
     * @return AffiliateDownloads
     */
    public function setLastUpdated($lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;

        return $this;
    }

    /**
     * Get lastUpdated
     *
     * @return \DateTime 
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }
}
