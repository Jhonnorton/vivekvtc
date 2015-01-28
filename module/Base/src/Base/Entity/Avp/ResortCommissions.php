<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * ResortCommissions
 *
 * @ORM\Table(name="resort_commissions")
 * @ORM\Entity
 */
class ResortCommissions
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
     * Set resortId
     *
     * @param integer $resortId
     * @return ResortCommissions
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
     * Set commissionId
     *
     * @param integer $commissionId
     * @return ResortCommissions
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
