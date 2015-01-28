<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permissions
 *
 * @ORM\Table(name="permissions", indexes={@ORM\Index(name="FK_permissions_role_id", columns={"role_id"}), @ORM\Index(name="FK_permissions_resource_id", columns={"resource_id"})})
 * @ORM\Entity
 */
class Permissions extends Base\BaseEntity
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
     * @var integer
     *
     * @ORM\Column(name="permission", type="integer", nullable=false)
     */
    protected $permission = '1';

    /**
     * @var \Base\Entity\Resource
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Resource")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="resource_id", referencedColumnName="id")
     * })
     */
    protected $resource;

    /**
     * @var \Base\Entity\Role
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Role")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * })
     */
    protected $role;



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
     * Set permission
     *
     * @param integer $permission
     * @return Permissions
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;

        return $this;
    }

    /**
     * Get permission
     *
     * @return integer 
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Set resource
     *
     * @param \Base\Entity\Resource $resource
     * @return Permissions
     */
    public function setResource(\Base\Entity\Resource $resource = null)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return \Base\Entity\Resource 
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set role
     *
     * @param \Base\Entity\Role $role
     * @return Permissions
     */
    public function setRole(\Base\Entity\Role $role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return \Base\Entity\Role 
     */
    public function getRole()
    {
        return $this->role;
    }
}
