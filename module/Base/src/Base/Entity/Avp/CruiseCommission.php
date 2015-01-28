<?php

namespace Base\Entity\Avp;

use Doctrine\ORM\Mapping as ORM;

/**
 * CruiseCommission
 *
 * @ORM\Table(name="cruise_commissions")
 * @ORM\Entity
 */
class CruiseCommission
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
     * @ORM\Column(name="cruise_id", type="integer", nullable=false)
     */
    private $cruiseId;

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
     * Set cruiseId
     *
     * @param integer $cruiseId
     * @return CruiseCommission
     */
    public function setCruiseId($cruiseId)
    {
        $this->cruiseId = $cruiseId;

        return $this;
    }

    /**
     * Get cruiseId
     *
     * @return integer 
     */
    public function getCruiseId()
    {
        return $this->cruiseId;
    }

    /**
     * Set commissionId
     *
     * @param integer $commissionId
     * @return CruiseCommission
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
