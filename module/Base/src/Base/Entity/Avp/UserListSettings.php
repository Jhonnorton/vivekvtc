<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserListSettings
 *
 * @ORM\Table(name="user_list_settings")
 * @ORM\Entity
 */
class UserListSettings
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="commission", type="float", precision=10, scale=0, nullable=true)
     */
    private $commission;

    /**
     * @var float
     *
     * @ORM\Column(name="processing_fee", type="float", precision=10, scale=0, nullable=true)
     */
    private $processingFee;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100, nullable=false)
     */
    private $slug;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_updated", type="date", nullable=true)
     */
    private $lastUpdated;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added_on", type="date", nullable=true)
     */
    private $addedOn;



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
     * @return UserListSettings
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
     * Set description
     *
     * @param string $description
     * @return UserListSettings
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set commission
     *
     * @param float $commission
     * @return UserListSettings
     */
    public function setCommission($commission)
    {
        $this->commission = $commission;

        return $this;
    }

    /**
     * Get commission
     *
     * @return float 
     */
    public function getCommission()
    {
        return $this->commission;
    }

    /**
     * Set processingFee
     *
     * @param float $processingFee
     * @return UserListSettings
     */
    public function setProcessingFee($processingFee)
    {
        $this->processingFee = $processingFee;

        return $this;
    }

    /**
     * Get processingFee
     *
     * @return float 
     */
    public function getProcessingFee()
    {
        return $this->processingFee;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return UserListSettings
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string 
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return UserListSettings
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set lastUpdated
     *
     * @param \DateTime $lastUpdated
     * @return UserListSettings
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

    /**
     * Set addedOn
     *
     * @param \DateTime $addedOn
     * @return UserListSettings
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
}
