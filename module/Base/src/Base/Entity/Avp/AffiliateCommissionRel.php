<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * AffiliateCommissionRel
 *
 * @ORM\Table(name="affiliate_commission_rel")
 * @ORM\Entity
 */
class AffiliateCommissionRel
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
     * @ORM\Column(name="affiliate_id", type="integer", nullable=false)
     */
    private $affiliateId;

    /**
     * @var integer
     *
     * @ORM\Column(name="commission_id", type="integer", nullable=false)
     */
    private $commissionId;



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
     * Set affiliateId
     *
     * @param integer $affiliateId
     * @return AffiliateCommissionRel
     */
    public function setAffiliateId($affiliateId)
    {
        $this->affiliateId = $affiliateId;

        return $this;
    }

    /**
     * Get affiliateId
     *
     * @return integer 
     */
    public function getAffiliateId()
    {
        return $this->affiliateId;
    }

    /**
     * Set commissionId
     *
     * @param integer $commissionId
     * @return AffiliateCommissionRel
     */
    public function setCommissionId($commissionId)
    {
        $this->commissionId = $commissionId;

        return $this;
    }

    /**
     * Get commissionId
     *
     * @return integer 
     */
    public function getCommissionId()
    {
        return $this->commissionId;
    }
}
