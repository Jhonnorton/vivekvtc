<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Documents
 *
 * @ORM\Table(name="documents")
 * @ORM\Entity
 */
class Documents extends Base\BaseEntity
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
     * @ORM\Column(name="type", type="string", length=64, nullable=false)
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(name="type_id", type="text", nullable=true)
     */
    protected $typeId;

    /**
     * @var String
     *
     * @ORM\Column(name="file", type="text", nullable=false)
     */
    protected $file;

 /**
     * @var string
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    protected $status;
    
     /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="date", nullable=false)
     */
    protected $created;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="modified", type="date", nullable=false)
     */
    protected $modified;



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
     * Set type
     *
     * @param integer $type
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get $type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set typeId
     *
     * @param integer $typeId
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;

        return $this;
    }

    /**
     * Get typeId
     *
     * @return integer 
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * Set file
     *
     * @param string $file
     * @return Documents
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
     * Set status
     *
     * @param boolean
     * @return Documents
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return boolean 
     */
    public function getStatus()
    {
        return $this->status;
    }
    
    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Documents
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set modified
     *
     * @param \DateTime $modified
     * @return Documents
     */
    public function setModified($modifed)
    {
        $this->modified = $modified;

        return $this;
    }

    /**
     * Get modified
     *
     * @return \DateTime 
     */
    public function getModified()
    {
        return $this->modified;
    }
}
