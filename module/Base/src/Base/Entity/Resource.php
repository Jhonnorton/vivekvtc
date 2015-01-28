<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Resource
 *
 * @ORM\Table(name="resource",indexes={@ORM\Index(name="FK_resource_module_id", columns={"module_id"})})
 
 * @ORM\Entity
 */
class Resource extends Base\BaseEntity
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=128, nullable=false)
     */
    protected $name;
    
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="original_name", type="string", length=255, nullable=true)
     */
    protected $originalname;
    
    
    
    /**
     * @var \Base\Entity\Modules
     *
     * @ORM\ManyToOne(targetEntity="Base\Entity\Modules")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="module_id", referencedColumnName="id")
     * })
     */
    protected $module;

    
     /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    protected $status;
    
    


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
     * @return Resource
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
     * Set originalname
     *
     * @param string $originalname
     * @return Resource
     */
    public function setOriginalname($originalname)
    {
        $this->originalname = $originalname;

        return $this;
    }

    /**
     * Get originalname
     *
     * @return string 
     */
    public function getOriginalname()
    {
        return $this->originalname;
    }
    
     
      /**
     * Set module
     *
     * @param \Base\Entity\Modules $module
     * @return Resource
     */
    public function setModule(\Base\Entity\Modules $module = null)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return \Base\Entity\Modules 
     */
    public function getModule()
    {
        return $this->module;
    }
    
    
     /**
     * Set status
     *
     * @param integer $status
     * @return Resource
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
}
