<?php
namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Activity
 *
 * @ORM\Table(name="reseller_accounts_roles")
 * @ORM\Entity
 */

class ResellerAccountsRoles extends Base\BaseEntity
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
     * @var \Base\Entity\ResellerAccounts
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\ResellerAccounts")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reseller_accounts_id", referencedColumnName="id")
     * })
     */
    protected $resellerAccountsId;
    
     /**
     * @var \Base\Entity\ResellerRolesActivity
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\ResellerRolesActivity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reseller_roles_activity_id", referencedColumnName="id")
     * })
     */
    protected $resellerRolesAcitivityId;
    
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
     * Set resellerAccountsId
     *
     * @param integer $resellerAccountsId
     * @return ResellerAccountsRoles
     */
    public function setResellerAccountsId($resellerAccountsId) {
        $this->resellerAccountsId = $resellerAccountsId;

        return $this;
    }

    /**
     * Get resellerAccountsId
     *
     * @return integer 
     */
    public function getResellerAccountsId() {
        return $this->resellerAccountsId;
    }
    /**
     * Set resellerRolesAcitivityId
     *
     * @param integer $resellerRolesAcitivityId
     * @return ResellerAccountsRoles
     */
    public function setResellerRolesAcitivityId($resellerRolesAcitivityId) {
        $this->resellerRolesAcitivityId = $resellerRolesAcitivityId;

        return $this;
    }

    /**
     * Get resellerRolesAcitivityId
     *
     * @return integer 
     */
    public function getResellerRolesAcitivityId() {
        return $this->resellerRolesAcitivityId;
    }
 }