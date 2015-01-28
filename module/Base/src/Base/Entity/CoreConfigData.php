<?php

namespace Base\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CoreConfigData
 *
 * @ORM\Table(name="core_config_data")
 * @ORM\Entity
 */
class CoreConfigData extends Base\BaseEntity
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
     * @ORM\Column(name="option", type="string", length=64, nullable=false)
     */
    protected $option;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=64, nullable=false)
     */
    protected $value;



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
     * Set option
     *
     * @param string $option
     * @return CoreConfigData
     */
    public function setOption($option)
    {
        $this->option = $option;

        return $this;
    }

    /**
     * Get option
     *
     * @return string 
     */
    public function getOption()
    {
        return $this->option;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return CoreConfigData
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }
}
